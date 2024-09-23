<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Model
{
   
    /**
     * Retrieve a paginated list of books from the database.
     * Owned by Cherry Ann
     */ 
    public function get_paginated_books($offfset, $limit)
    {
        $query = $this->db->query("SELECT * FROM books LIMIT ?, ?", array($offfset, $limit));
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
     * Borrow a book for the current student.
     * This function checks if the book has already been borrowed by the student.
     * If not, it creates a new borrowing record.
     * Owned by Cherry Ann
    */
    public function borrow_book($book_id)
    {
        // Check if the book has already been borrowed and has not been returned by the current student
        $query = "SELECT * FROM records WHERE school_id = ? AND book_id = ? AND date_of_return IS NULL";
        $values = array(
                    $this->session->userdata('school_id'), 
                    $this->security->xss_clean($book_id));
        
        $existing_record = $this->db->query($query, $values)->row();

        if ($existing_record) {
            return false; // The book has already been borrowed by this student and not yet returned
        }

        // Insert new record if it does not exist
        $query = "INSERT INTO records (school_id, book_id, created_at, updated_at)
                VALUES (?, ?, NOW(), NOW())";
        $values = array(
                    $this->session->userdata('school_id'), 
                    $this->security->xss_clean($book_id));
        
        return $this->db->query($query, $values);
    }

    /**
     * Retrieve currently borrowed books for the logged-in student.
     * This function fetches details about books currently borrowed by the student,
     * including their renewal status.
     * Owned by Cherry Ann
     */
    public function currently_borrowed_books()
    {
        $id = $this->session->userdata('school_id');

        $query = "SELECT books.id as book_id, books.accesion, books.title, records.date_of_issue, records.due_date, records.renewals_left,
                        COALESCE(renew.status, 'none') as renewal_status
                    FROM records
                    INNER JOIN users ON users.school_id = records.school_id
                    INNER JOIN books ON books.id = records.book_id
					LEFT JOIN renew ON renew.book_id = books.id AND renew.school_id = users.school_id
                    WHERE users.school_id = ? AND records.date_of_return IS NULL AND records.date_of_issue IS NOT NULL
                    ORDER BY records.date_of_issue DESC";

        return $this->db->query($query, array($id))->result_array();
    }

   
    /**
     * DOCU: This function retrieves a paginated list of previously borrowed books that have been returned.
     * Owned by Cherry Ann
     */
    public function get_previously_borrowed_books($limit = 8, $offset = 0)
    {
        $id = $this->session->userdata('school_id');

        $query = "SELECT books.accesion, books.title, records.date_of_issue, records.date_of_return
                    FROM records
                    INNER JOIN users
						ON users.school_id = records.school_id
					INNER JOIN books
						ON books.id = records.book_id
                    WHERE users.school_id = ? 
                        AND date_of_issue IS NOT NULL 
                        AND date_of_return IS NOT NULL -- AND books.id = records.book_id
                    ORDER BY records.date_of_return DESC
                    LIMIT ? OFFSET ?";

        return $this->db->query($query, array($id, $limit, $offset))->result_array();
    }   

    /**
     * Get the count of previously borrowed books for the logged-in student.
     * This function retrieves the number of books that have been borrowed
     * and returned by the current user.
     * Owned by Cherry Ann
     */
    public function get_previously_borrowed_book_count($limit = 8, $offset = 0)
    {
        $id = $this->session->userdata('school_id');
        
        $query = "SELECT COUNT(*) as count 
                    FROM records 
                    INNER JOIN users
						ON users.school_id = records.school_id
                    INNER JOIN books
						ON books.id = records.book_id
                        WHERE users.school_id = ? 
                        AND date_of_issue IS NOT NULL 
                        AND date_of_return IS NOT NULL";
        return $this->db->query($query, array($id))->row()->count;
    }
    
    /**
     * Request to renew a borrowed book.
     * This function checks if a renewal request is already pending for the specified book.
     * If not, it inserts a new renewal request with a status of 'pending'.
     * Owned by Cherry Ann
     */ 
    public function renew_book($book_id)
    {
        $school_id = $this->session->userdata('school_id');
        $clean_book_id = $this->security->xss_clean($book_id);

        // Check if a renewal request is already pending
        $query = "SELECT * FROM renew WHERE school_id = ? AND book_id = ? AND status = 'pending'";
        $values = array($school_id, $clean_book_id);
        
        $existing_record = $this->db->query($query, $values)->row();

        if ($existing_record) {
            return false; // The renewal request is already pending
        }

        // Insert a new renewal request with 'pending' status
        $query = "INSERT INTO renew (school_id, book_id, status, created_at, updated_at)
                VALUES (?, ?, 'pending', NOW(), NOW())";
        $values = array($school_id, $clean_book_id);
        
        return $this->db->query($query, $values);
    }

    /**
     * Process the return of a borrowed book.
     * This function checks if the specified book has already been returned by the user.
     * If not, it inserts a new return record into the database.
     * Owned by Cherry Ann
     */
    public function return_book($book_id)
    {
        $school_id = $this->session->userdata('school_id');
        $clean_book_id = $this->security->xss_clean($book_id);

        // Check if the book has already been returned
        $query = "SELECT * FROM returns WHERE school_id = ? AND book_id = ?";
        $values = array($school_id, $clean_book_id);
        $existing_return = $this->db->query($query, $values)->row();

        if ($existing_return) {
            return false; // The book has already been returned
        }

        $query = "INSERT INTO returns (school_id, book_id, created_at, updated_at)
        VALUES (?, ?, NOW(), NOW())";

        return $this->db->query($query, $values);
    }

    /**
     * Check if a specific book has been returned by the user.
     * This function queries the database to determine if there is a return record
     * for the specified book ID associated with the current user's school ID.
     * Owned by Cherry Ann
     */
    public function is_book_returned($book_id)
    {
        $school_id = $this->session->userdata('school_id');
        $query = "SELECT * FROM returns WHERE school_id = ? AND book_id = ?";
        $values = array($school_id, $book_id);
        
        return $this->db->query($query, $values)->row() !== null; // Returns true if found, false otherwise
    }

    /**
     * Retrieve messages for the current user, with pagination.
     * Owned by Cherry Ann
     */
    public function message($limit = 8, $offset = 0)
    {
        $school_id = $this->session->userdata('school_id');

        $query = "SELECT * FROM messages 
                  WHERE school_id = ? 
                  ORDER BY created_at DESC
                  LIMIT ? OFFSET ?";

        return $this->db->query($query, array($school_id, $limit, $offset))->result_array();
    }
   
    /**
     * Get the count of messages for the current user.
     * This function retrieves the total number of messages associated
     * with the user's school ID.
     * Owned by Cherry Ann
     */
    public function get_message_count()
    {
        $school_id = $this->session->userdata('school_id');

        $query = "SELECT COUNT(*) as count FROM messages WHERE school_id = ?";
        return $this->db->query($query, array($school_id))->row()->count;
    }


    /**
     * Count the number of books currently borrowed by the user.
     * This function retrieves the count of books that are borrowed
     * and not yet returned for the user identified by their school ID.
     * Owned by Cherry Ann
     */
    public function count_borrow_books()
    { 
        $id = $this->session->userdata('school_id');
        $query = "SELECT COUNT(records.id) as count
                    FROM books
                    LEFT JOIN records ON books.id = records.book_id
                    LEFT JOIN users ON users.school_id = records.school_id
                    WHERE users.school_id = ? AND records.date_of_return IS NULL";
        
        return $this->db->query($query, $id)->row_array();
    }
}

?>