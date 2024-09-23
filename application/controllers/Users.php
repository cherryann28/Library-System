<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public function __construct()
	{
	  parent::__construct();
	  $this->load->library('session'); 
	  $this->load->model('User');		
	
	}

	/*
	* DOCU: This function displays the home page with book statistics.
	* It counts total books, borrowed books, and returned books.
	* Owned by Cherry Ann Nepomuceno
	*/
	public function index()
	{
		$data['books_total'] = $this->User->count_all_books();
		$data['borrowed'] = $this->User->total_issued_books();
		$data['returned'] = $this->User->total_returned_books();
		$this->load->view('home', $data);
	}

	/*
	* DOCU: This function displays the login page.
	* It prepares data for the login view.
	* Owned by Cherry Ann Nepomuceno
	*/
	public function login()
	{
		$data['books_total'] = $this->User->count_all_books();
		$data['borrowed'] = $this->User->total_issued_books();
		$data['returned'] = $this->User->total_returned_books();
		$this->load->view('login', $data);
	}

	/*
	* DOCU: This function processes the login form.
	* It validates user credentials and sets session data if successful.
	* Redirects to the appropriate page based on user level.
	* Owned by Cherry Ann Nepomuceno
	*/
	public function login_process()
	{
 		$result = $this->User->validate_login($this->input->post());
    	if ($result != 'success') {
			$errors = array(
				'email' => form_error('email'),
				'password' => form_error('password')
			);
			$this->session->set_flashdata($errors);
			redirect('login');
		} else {
			$email = $this->input->post('email');
			$user = $this->User->get_users_by_email($email);
			$password = $this->input->post('password');

			$result = $this->User->validate_login_match($user, $password);

			if ($result == 'success') {
				$this->session->set_userdata(array(
					'logged_in' => true,    
					'user_id' => $user['id'],
					'school_id'=> $user['school_id'], 
					'user_level' => $user['user_level'],
					'name' => $user['name'],
				));
				
				if ($user['user_level'] == 'admin') {
					redirect('admins'); 
				} else {
					redirect('students'); 
				}
			} else {
				$this->session->set_flashdata('invalid', 'Incorrect email/password'); 
				redirect('login'); 
			}
		}
	}
	
	/*
	* DOCU: This function displays the create account form.
	* It prepares data for the create account view.
	* Owned by Cherry Ann Nepomuceno 
	*/
	public function create_account()
	{
		$data['books_total'] = $this->User->count_all_books();
		$data['borrowed'] = $this->User->total_issued_books();
		$data['returned'] = $this->User->total_returned_books();
		$this->load->view('create_account', $data);
	}

	/*
	* DOCU: This function validates and processes the create account form.
	* If valid, it saves the data into the users table; otherwise, it prompts an error message.
	* Owned by Cherry Ann
	*/
	public function process_create_account()
	{
		// var_dump($this->input->post());
		$result = $this->User->validate_create_account($this->input->post());
		if($result == 'valid')
		{
			$this->User->create_account($this->input->post()); 
			$success[] = 'Welcome! Create account was successful!';
			$this->session->set_flashdata('success', $success);
			redirect('create_account'); 
		}
		else
		{
			$errors = array(
				'school_id' => form_error('school_id'),
				'name' => form_error('name'),
				'contact_number' => form_error('contact_number'),
				'user_level' => form_error('user_level'),
				'email' => form_error('email'),
				'password' => form_error('password'),
			);
			$this->session->set_flashdata($errors); 
			redirect('create_account'); 
		}
	}

	/*
    * DOCU: This function displays the user profile.
    * It fetches user details and loads the appropriate header and footer 
    * based on the user's role (admin or student).
    * Owned by Cherry Ann
	*/
	public function profile()
    {

		// Check if user is logged in
		if (!$this->session->userdata('user_id')) {
			redirect('login'); // Redirect to login page if not logged in
			return;
		}
        $data['users'] = $this->User->get_user_details();
		
		// Check if the user is an admin
		$is_admin = $this->session->userdata('user_level') === 'admin';

		 // Load appropriate header and footer
		 $this->load->view($is_admin ? 'templates/header' : 'templates/student_header');
		 $this->load->view('user/profile', $data);
		 $this->load->view($is_admin ? 'templates/footer' : 'templates/student_footer');
    }

	/*
    * DOCU: This function retrieves a user's details for editing.
    * It checks if the user is an admin and loads the appropriate header 
    * and footer based on their role.
    * Owned by Cherry Ann
	*/
    public function edit_user($id)
    {
        $data['user'] = $this->User->get_user_by_id($id);

		// Check if the user is an admin
		$is_admin = $this->session->userdata('user_level') === 'admin';

		// Load appropriate header and footer
		$this->load->view($is_admin ? 'templates/header' : 'templates/student_header');
		$this->load->view('user/update_profile', $data);
		$this->load->view($is_admin ? 'templates/footer' : 'templates/student_footer');
    }

	/*
    * DOCU: This function processes the update of a user's details.
    * It validates the user data and updates the database if validation passes.
    * If validation fails, it redirects back to the edit form with error messages.
    * Owned by Cherry Ann
	*/
    public function process_update_user($id)
    {
        $update_user = $this->User->validate_update_user($id); 
        
        if($update_user == 'success')
        {
            $this->User->update_user($this->input->post());
            $success[] = "Updated successfully!";
            $this->session->set_flashdata('success', $success);
            redirect('users/profile');
        }
        else
        {
            $errors = array(
                'school_id' => form_error('school_id'),
                'name' => form_error('name'),
                'contact_number' => form_error('contact_number'),
                'email' => form_error('email'),
                'password' => form_error('password'),
            );  
            $this->session->set_flashdata($errors);
            redirect('users/edit_user/' . $id);
        }
    }

	/*
	* DOCU: This function logs out the user by destroying the session.
	* Owned by Cherry Ann Nepomuceno
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('users');
	}

}
