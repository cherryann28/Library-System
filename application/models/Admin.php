<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model
{
	/**
	 * Retrieve a paginated list of users excluding admin users.
	 * Owned by Cherry Ann
	*/
	public function get_paginated_users($limit, $offset)
	{
		$query = $this->db->query("SELECT * FROM users WHERE user_level != 'admin' LIMIT ?, ?", array($offset, $limit));
		return $query->result_array();
	}

	/**
	 * Count the total number of users excluding admin user.
	 * Owned by Cherry Ann
	 */
	public function count_users()
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM users WHERE user_level != 'admin'");
        $result = $query->row_array();
        return $result['count'];
    }

	/**
	 * Search for students based on various criteria such as school ID, email, contact number, or name.
	 * Owned by Cherry Ann
	 */
	public function search_student($student) 
	{
		$sql = "SELECT * FROM users 
				WHERE user_level = 'student'
				AND (school_id LIKE ? 
				OR email LIKE ? 
				OR contact_number LIKE ?
				OR name LIKE ?)";
	
		$likeStudent = "%{$student}%";

		$query = $this->db->query($sql, array($likeStudent, $likeStudent, $likeStudent, $likeStudent));
	
		return $query->result_array();
	}

	/**
	 * Retrieve a paginated list of books.
	 * Owned by Cherry Ann
	 */
	public function get_paginated_books($limit, $offset)
    {
        $query = $this->db->query("SELECT * FROM books LIMIT ?, ?", array($offset, $limit));
        return $query->result_array();
    }

	/**
	 * Count the total number of books in the database.
	 * Owned by Cherry Ann
	 */
    public function count_books()
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM books");
        $result = $query->row_array();
        return $result['count'];
    }

	/**
	 * Retrieve a paginated list of currently issued books along with user and record details.
	 * owned by Cherry Ann
	 */
	public function get_paginated_currently_issued_books($limit, $offset)
	{
		$query = "SELECT users.school_id, 
						 books.accesion, 
						 books.title, 
						 records.date_of_issue, 
						 records.due_date, 
						 DATEDIFF(CURDATE(), records.due_date) AS overdue_days,
						 CASE 
                         	WHEN DATEDIFF(CURDATE(), records.due_date) > 0 
							THEN DATEDIFF(CURDATE(), records.due_date) * 10
                         	ELSE 0 
                    	 END AS dues
					FROM records	
					INNER JOIN users
						ON users.school_id = records.school_id
					INNER JOIN books
						ON books.id = records.book_id
					WHERE records.date_of_issue IS NOT NULL AND records.date_of_return IS NULL
					ORDER BY records.date_of_issue ASC, records.due_date ASC
					LIMIT ?, ?";

		return $this->db->query($query, array($offset, $limit))->result_array();
	}

	/**
	 * Count the total number of currently issued books.
	 * Owned by Cherry Ann
	 */
	public function count_currently_issued_books()
    {
        $query = $this->db->query("SELECT COUNT(*) as count FROM records WHERE date_of_issue IS NOT NULL AND date_of_return IS NULL");
        $result = $query->row_array();
        return $result['count'];
    }

    /**
	 * Add a new book to the database.
	 * Owned by Cherry Ann
	 */
    public function add_book($book)
    {
        $query = "INSERT INTO books (accesion, title, publisher, year, availability, created_at, updated_at)
                    VALUES (?,?,?,?,?,?,?)";
        $values = array($book['accesion'], $book['title'], $book['publisher'], $book['year'], $book['availability'],  
                        date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

	/**
	 * Validate the book addition form input.
	 * Owned by Cherry Ann
	 */
	public function validate_add_book()
    {
		$this->load->library('form_validation');

		$validation_rules = array(
			array('field' => 'accesion', 'label' => 'Accesion', 'rules' => 'required|numeric'),
			array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
			array('field' => 'publisher', 'label' => 'Publisher', 'rules' => 'required'),
			array('field' => 'year', 'label' => 'Year', 'rules' => 'required|numeric'),
			array('field' => 'availability', 'label' => 'Availability', 'rules' => 'required|numeric'),
		);

		$this->form_validation->set_rules($validation_rules);

		if(!$this->form_validation->run()){
			return validation_errors();
		}
		return 'success';
    }
	
	/*
     * DOCU: This function retrieves a book filtered by its ID.
     * Owned by Cherry Ann
	*/
	public function get_book_by_id($id)
	{
		return $this->db->query("SELECT * FROM books WHERE id = ?", array($id))->row_array();
	}

	/*
	 * DOCU: This function is to Update a book's details in the database.
	 * Owned by Cherry Ann
	*/
	public function update_book($book)
    {  
        $query = "UPDATE books SET accesion = ?, title = ?, publisher = ?, year = ?, availability = ?, updated_at = NOW()
                    WHERE id = ?";
        $values = array($book['accesion'], $book['title'], $book['publisher'], $book['year'], $book['availability'], $book['id']);
        return $this->db->query($query, $values);
        
    }	

	/**
	 * Validate the book update form input.
	 * Owned by Cherry Ann
	 */
	public function validate_update_book()
    {
		$this->load->library('form_validation');

		$validation_rules = array(
			array('field' => 'accesion', 'label' => 'Accesion', 'rules' => 'required|numeric'),
			array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
			array('field' => 'publisher', 'label' => 'Publisher', 'rules' => 'required'),
			array('field' => 'year', 'label' => 'Year', 'rules' => 'required|numeric'),
			array('field' => 'availability', 'label' => 'Availability', 'rules' => 'required'),
		);

		$this->form_validation->set_rules($validation_rules);

		if(!$this->form_validation->run()){
			return validation_errors();
		}
		return 'success';
    }
	 
	/**
	 * Search for books based on accesion, title, or publisher.
	 * Owned by Cherry Ann
	*/
	public function search_book($book){
		$sql = "SELECT * FROM books WHERE accesion LIKE ? OR title LIKE ? OR publisher LIKE ?";
		$likeBook = "%{$book}%";
		$query = $this->db->query($sql, array($likeBook, $likeBook, $likeBook));
		return $query->result_array();
	}
	
	/**
	 * Add a message to the messages table.
	 * Owned by Cherry Ann
	 */
	public function add_message($message)
    {
        $query = "INSERT INTO messages (school_id, content, created_at, updated_at)
                    VALUES (?,?, NOW(), NOW())";
        $values = array($message['school_id'], $message['content']);
        return $this->db->query($query, $values);
    }

	/**
	 * Validate the message input from the form.
	 * Owned by Cherry Ann
	 */
	public function validate_message()
	{
		$this->load->library('form_validation');

		$validation_rules = array(
			array('field' => 'school_id', 'label' => 'Student ID', 'rules' => 'required|numeric'),
			array('field' => 'content', 'label' => 'Content', 'rules' => 'required'),
		);
       
		$this->form_validation->set_rules($validation_rules);

        if(!$this->form_validation->run()){
            return validation_errors();
        }
		return 'success';
	}

	/**
	 * Retrieve all records of books that have not been issued, with pagination.
	 * Owned by Cherry Ann
	*/
	public function get_all_records($limit = 8, $offset = 0)
	{
		$query = "SELECT books.id as book_id, records.id, users.school_id, books.accesion, books.title, books.availability, users.user_level
					FROM records
					INNER JOIN users	
						ON users.school_id = records.school_id
					INNER JOIN books
						ON books.id = records.book_id
					WHERE records.date_of_issue IS NULL
					LIMIT ? OFFSET ?";

		return $this->db->query($query, array($limit, $offset))->result_array();
	}

	/**
	 * Count the total number of records where books have not been issued.
	 * Owned by Cherry Ann
	*/
	public function count_all_records()
	{
		$query = "SELECT COUNT(*) as total
				FROM records
				WHERE records.date_of_issue IS NULL";

		$result = $this->db->query($query)->row_array();
		return $result['total'];
	}
	
	/**
	 * Accept a book issue request for a student by updating the record.
	 * Owned by Cherry Ann
	 */
	public function accept_book_student($record_id)
	{
		$safe_record_id = $this->security->xss_clean($record_id);
		$query = "UPDATE records
					SET date_of_issue = NOW(), updated_at = NOW(),
						due_date = DATE_ADD(NOW(), INTERVAL 14 DAY), renewals_left = 1
					WHERE id = ?";

		return $this->db->query($query, $safe_record_id); 
		
	} 

	/**
	 * Decrease the availability of a book by updating its count in the database.
	 * Owned by Cherry Ann
 	*/
	public function availability($book_id)
	{
		$safe_book_id = $this->security->xss_clean($book_id);
		$query = "UPDATE books SET availability = availability - 1, updated_at = NOW()
					WHERE id = ?";
		
		return $this->db->query($query, $safe_book_id);
	}
	
	/**
	 * Decline a borrow book request by deleting the corresponding record.
	 * Owned by Cherry Ann
	 */
	public function decline_borrow_book($record_id)
	{
		$safe_record_id = $this->security->xss_clean($record_id);
		$query = "DELETE FROM records WHERE id = ?";

		return $this->db->query($query, $safe_record_id);
	}

	/**
	 * Send a notification message to a student regarding their book request.
	 * Owned by Cherry Ann
	 */
	public function messenger($school_id)
	{
		$safe_school_id = $this->security->xss_clean($school_id);	
		$message_content = 'Your request for issue of book has been accepted';
		
		$query = "INSERT INTO messages (school_id, content, created_at, updated_at)
				VALUES (?, ?, NOW(), NOW())";
		
		return $this->db->query($query, array($safe_school_id, $message_content));
	}

	/**
	 * Send a notification message to a student regarding the decline of their book request.
	 * Owned by Cherry Ann
	 */
	public function decline_message($school_id)
	{
		$safe_school_id = $this->security->xss_clean($school_id);
		$message_content = 'Your request for issue of book has been declined';
		
		$query = "INSERT INTO messages (school_id, content, created_at, updated_at)
				VALUES (?, ?, NOW(), NOW())";
		
		return $this->db->query($query, array($safe_school_id, $message_content));
	}

	/**
	 * Retrieve all renewal records with pagination.
	 * Owned by Cherry Ann
	 */
	public function get_all_renew($limit = 8, $offset = 0)
	{
		$query = "SELECT records.id as record_id, renew.id as renew_id, renew.school_id, renew.book_id, books.title, books.accesion, users.user_level, records.renewals_left
				  FROM records
				  INNER JOIN users ON users.school_id = records.school_id
				  INNER JOIN books ON records.book_id = books.id
				  INNER JOIN renew ON renew.book_id = books.id
				  WHERE renew.school_id = records.school_id
					AND renew.book_id = records.book_id
					AND users.school_id = records.school_id
					AND records.date_of_return IS NULL
				  LIMIT ? OFFSET ?";
	
		return $this->db->query($query, array($limit, $offset))->result_array();
	}

	/**
	 * Count the total number of active renewal records.
	 * Owned by Cherry Ann
	 */
	public function count_all_renew()
	{
		$query = "SELECT COUNT(*) as total
				FROM records
				INNER JOIN renew ON renew.book_id = records.book_id
				WHERE renew.school_id = records.school_id
					AND records.date_of_return IS NULL";

		$result = $this->db->query($query)->row_array();
		return $result['total'];
	}

	/**
	 * Retrieve all return records with pagination.
	 * Owned by Cherry Ann
	 */
	public function get_all_return($limit = 8, $offset = 0)
	{
		$query = "SELECT returns.id as return_id, 
						 returns.school_id, 
						 returns.book_id, 
						 books.id as book_id, 
						 records.id as record_id, 
						 books.accesion, 
						 books.title, 
						 DATEDIFF(CURDATE(), records.due_date) AS overdue_days,
						 CASE 
							WHEN DATEDIFF(CURDATE(), records.due_date) > 0 
							THEN (DATEDIFF(CURDATE(), records.due_date)) * 10
							ELSE 0 
						END AS dues
					FROM returns
					LEFT JOIN books
						ON returns.book_id = books.id
					LEFT JOIN records
						ON records.book_id = books.id AND records.school_id = returns.school_id
					WHERE returns.book_id = books.id AND records.date_of_return IS NULL
					LIMIT ? OFFSET ?";

		return $this->db->query($query, array($limit, $offset))->result_array();
	}

	/**
	 * Count the total number of return records that have not been returned.
	 * Owned by Cherry Ann	
	 */
	public function count_all_return()
	{
		$query = "SELECT COUNT(*) as total
				FROM records
				INNER JOIN returns ON returns.book_id = records.book_id
				WHERE returns.school_id = records.school_id
					AND records.date_of_return IS NULL";

		$result = $this->db->query($query)->row_array();
		return $result['total'];
	}

	/**
	 * Accept the return of a book and update the corresponding record.
	 * Owned by Cherry Ann
	 */
	public function accept_return_book($record_id, $book_id, $school_id )
	{
		$safe_record_id = $this->security->xss_clean($record_id);
		$safe_book_id = $this->security->xss_clean($book_id);
		$safe_school_id = $this->security->xss_clean($school_id);

		$query = "UPDATE records
					SET date_of_return = NOW(), updated_at = NOW(),
						dues =  datediff(curdate(), due_date)
					WHERE id = ? AND book_id = ? AND school_id = ?";

		$values = array($safe_record_id, $safe_book_id, $safe_school_id);
		return $this->db->query($query, $values);
	}
	
	/**
	 * Update the availability of a book when it is returned.
	 * Owned by Cherry Ann
	 */
	public function return_availability($book_id)
	{
		$safe_book_id = $this->security->xss_clean($book_id);
		
		$query = "UPDATE books SET availability = availability + 1, updated_at = NOW()
					WHERE id = ?";
		
		return $this->db->query($query, $safe_book_id);
	}


	/**
	 * Delete a return request from the database.
	 * Owned by Cherry Ann
	 */
	public function delete_return_book($return_id, $school_id, $book_id)
	{
		$safe_return_id = $this->security->xss_clean($return_id);		
		$safe_school_id = $this->security->xss_clean($school_id);
		$safe_book_id = $this->security->xss_clean($book_id);

		$query = "DELETE FROM returns WHERE id = ? AND school_id = ? AND book_id = ?";
		$values = array($safe_return_id, $safe_school_id, $safe_book_id);

		return $this->db->query($query, $values);
	}

	
	/**
	 * Send a notification message to the student regarding the acceptance of their book return request.
	 * Owned by Cherry Ann
	 */
	public function return_message($school_id)
	{
		$safe_school_id = $this->security->xss_clean($school_id);
		$message_content = 'Your request for return of book has been accepted';
		
		$query = "INSERT INTO messages (school_id, content, created_at, updated_at)
				VALUES (?, ?, NOW(), NOW())";
		
		return $this->db->query($query, array($safe_school_id, $message_content));

	}

	/**
	 * Accept a renewal request for a book.
	 * This function updates the renewal request status to 'approved'
	 * and adjusts the due date in the records table accordingly.
	 * Owned by Cherry Ann
	 */
	public function accept_renew_book($record_id, $school_id, $book_id)
	{
		$safe_record_id = $this->security->xss_clean($record_id);
		$safe_school_id = $this->security->xss_clean($school_id);
		$safe_book_id = $this->security->xss_clean($book_id);

		 // Update the renewal request to 'approved'
		$query = "UPDATE renew
				  SET status = 'approved', updated_at = NOW()
				  WHERE school_id = ? AND book_id = ? AND status = 'pending'";

		$values = array($safe_school_id, $safe_book_id);
		$this->db->query($query, $values);

		// Update the record with the new due date
		$query = "UPDATE records	
				  SET due_date = DATE_ADD(due_date, INTERVAL 7 DAY), updated_at = NOW(),
					  renewals_left = renewals_left - 1
				  WHERE id = ? AND school_id = ? AND book_id = ?";

		$values = array($safe_record_id, $safe_school_id, $safe_book_id);
		$this->db->query($query, $values);

		return true;
	}

	
	/**
	 * Delete a renewal request for a book.
	 * Owned by Cherry Ann
	 */
	public function delete_renew_book($renew_id, $school_id, $book_id)
	{
		$safe_renew_id = $this->security->xss_clean($renew_id);		
		$safe_school_id = $this->security->xss_clean($school_id);
		$safe_book_id = $this->security->xss_clean($book_id);

		$query = "DELETE FROM renew WHERE id = ? AND school_id = ? AND book_id = ?";

		$values = array($safe_renew_id, $safe_school_id, $safe_book_id);
		return $this->db->query($query, $values);
	}

	/**
	 * Send a message to the student indicating that their book renewal request has been accepted.
	 * Owned by Cherry Ann
	 */
	public function renew_message($school_id)
	{
		$safe_school_id = $this->security->xss_clean($school_id);
		$message_content = 'Your request for renewal of book has been accepted';
		
		$query = "INSERT INTO messages (school_id, content, created_at, updated_at)
				VALUES (?, ?, NOW(), NOW())";
		
		return $this->db->query($query, array($safe_school_id, $message_content));

	}
}

?>