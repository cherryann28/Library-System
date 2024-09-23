<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
    /*
	 * DOCU: This function retrieves a user filtered by email.
	 * Owned by Cherry Ann
	*/
    public function get_users_by_email($email)
    {
        return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
    }

    /*
	 * DOCU: This function retrieves all user information from the users table.
	 * Owned by Cherry Ann
	*/
    public function get_all_user()
    {
        return $this->db->query("SELECT * FROM users")->result_array();
    }

    /*
	 * DOCU: This function creates a user account.
	 * If there are no users, the first user is set as admin.
	 * Owned by Cherry Ann
	*/
    public function create_account($user)
    {
        // Check if there are no users in the system
        if ($this->get_all_user() == null) {
            // If this is the first user, set the user level to admin
            $user['user_level'] = 'admin';
        }

        // Hash the password
        $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO users (school_id, name, contact_number, email, password, user_level, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
            
        $values = array($user['school_id'], $user['name'], $user['contact_number'], 
                        $user['email'], $hashed_password, $user['user_level']);

        return $this->db->query($query, $values);
    }


    /*
	 * DOCU: This function validates the create account form.
	 * It checks each field against specified rules.
	 * Owned by Cherry Ann
	*/
    public function validate_create_account()
    {
        $this->load->library('form_validation');

        // Fetch current users
        $all_users = $this->get_all_user();

        $validation_rules = array(
            array('field' => 'school_id', 'label' => 'School ID', 'rules' => 'required|numeric'),
            array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|min_length[2]'),
            array('field' => 'contact_number', 'label' => 'Contact Number', 'rules' => 'trim|required|exact_Length[11]|numeric|is_unique[users.contact_number]|regex_match["^09.{9}$"]'),
            // Conditionally validate user_level if there are existing users
            array(
                'field' => 'user_level',
                'label' => 'Select option',
                'rules' => $all_users ? 'required|in_list[student,faculty]' : 'trim'
            ),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[users.email]'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[8]'),
        );

        $this->form_validation->set_rules($validation_rules);

        if(!$this->form_validation->run()){
            return validation_errors(); 
        }
        return 'valid';  
    }

    /*
	 * DOCU: This function validates the login form.
	 * It checks each field against specified rules.
	 * Owned by Cherry Ann
	*/
    public function validate_login()
    {
        $this->load->library('form_validation');
        $validation_rules =  array(
            array('field' =>  'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
        );

        $this->form_validation->set_rules($validation_rules);

        if(!$this->form_validation->run()){
            return validation_errors(); 
        }
        return 'success';
    }

     
    /*
	 * DOCU: This function checks if the password matches the stored password.
	 * Owned by Cherry Ann
	*/
    public function validate_login_match($user, $password)
    {
        // Use password_verify to check the hashed password
        if ($user && password_verify($password, $user['password'])) {
            return 'success';
        } else {
            return 'Incorrect email/password';
        }
    }

     /**
     * Count the total number of available books.
     * Owned by Cherry Ann
     */
    public function count_all_books()
	{
		return $this->db->query("SELECT SUM(availability) as availability FROM books")->row_array();
	}

   /**
     * Get the total number of currently issued books.
     * Owned by Cherry Ann
    */
    public function total_issued_books()
    {
        $query = "SELECT COUNT(id) as id 
                    FROM records 
                    WHERE date_of_issue IS NOT NULL AND due_date IS NOT NULL AND date_of_return IS NULL";

		return $this->db->query($query)->row_array();
    }

     /**
     * Get the total number of returned books.
     * Owned by Cherry Ann
     */
    public function total_returned_books()
    {
        return $this->db->query("SELECT COUNT(id) as id FROM returns")->row_array();
    }


    /*
    * DOCU: This function retrieves user details based on the given user ID.
    * Owned by Cherry Ann
    */
    public function get_user_by_id($id)
    {
        return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->row_array();
    }

    /*
    * DOCU: This function fetches details of the currently logged-in user.
    * Owned by Cherry Ann
    */
    public function get_user_details()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            return null; 
        }

        return $this->db->query("SELECT * FROM users WHERE id = ?", array($user_id))->row_array();
    }

    /*
    * DOCU: This function updates user information in the database.
    * It fetches current user details, checks for password changes,
    * and only updates the password if a new one is provided and differs from the current one.
    * Owned by Cherry Annn
    */
    public function update_user($user)
    {
         // Fetch the current user's details before updating
         $current_user = $this->get_user_by_id($user['id']);
    
         $query = "UPDATE users SET school_id = ?, name = ?, contact_number = ?, email = ?";
         $values = array($user['school_id'], $user['name'], $user['contact_number'], $user['email']);
 
        // Only hash and update the password if it's provided and differs from the current one
        if (!empty($user['password']) && $user['password'] !== $current_user['password']) {
            $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
            $query .= ", password = ?";
            $values[] = $hashed_password; 
        }
    
        $query .= " WHERE id = ?";
        $values[] = $user['id'];
    
        return $this->db->query($query, $values); 

    }

    /*
    * DOCU: This function validates user data for updates.
    * It checks required fields, formats, and uniqueness against current values.
    * Owned by Cherry Ann
    */
    public function validate_update_user($user_id) 
    {
        $this->load->library('form_validation');

        // Fetch the current user's details
        $current_user = $this->get_user_by_id($user_id);

        $current_contact = $current_user['contact_number'];
        $current_email = $current_user['email'];

        $validation_rules = array(
            array('field' => 'school_id', 'label' => 'School Id', 'rules' => 'required|numeric'),
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array(
                'field' => 'contact_number', 
                'label' => 'Contact number', 
                'rules' => 'trim|required|exact_length[11]|numeric|regex_match["^09.{9}$"]'
            ),
            array(
                'field' => 'email', 
                'label' => 'Email', 
                'rules' => 'trim|required|valid_email'
            ),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|min_length[8]'),
        );

        // Modify rules for uniqueness only if the value has changed
        if ($this->input->post('contact_number') !== $current_contact) {
            $validation_rules[2]['rules'] .= '|is_unique[users.contact_number]';
        }

        if ($this->input->post('email') !== $current_email) {
            $validation_rules[3]['rules'] .= '|is_unique[users.email]';
        }
        
        $this->form_validation->set_rules($validation_rules);

        if (!$this->form_validation->run()) {
            return validation_errors();
        }
        return 'success';
    }
}

?>