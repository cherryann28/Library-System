<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student');
		$this->load->model('User');	
		$this->load->library('session'); 
		
		$logged_in = $this->session->userdata('logged_in');
		if (!$logged_in) {
			redirect('login');
		}

		$user_level = $this->session->userdata('user_level');
		if ($user_level != 'student' && $user_level != 'faculty') {
			redirect('login');
		}
	  
	}

	/*
	 * DOCU: Displays the main student dashboard.
	 * Owned by Cherry Ann Nepomuceno
	 */
    public function index()
    {
		$this->load->view('student/index');
    }

	/*
	 * DOCU: Displays messages with pagination for the student.
	 * Owned by Cherry Ann Nepomuceno
	 */
	public function messages($page = 1)
	{	
		$limit = 8; // Number of records per page
        $offset = ($page - 1) * $limit;

		// Fetch records for the current page
        $data['messages'] = $this->Student->message($limit, $offset);

		// Calculate total number of records and pages
        $total_messages = $this->Student->get_message_count();
        $total_pages = ceil($total_messages / $limit);

		// Pass pagination data to the view
        $data['pagination'] = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'base_url' => base_url('students/messages'),
        ];

		$this->load->view('templates/student_header');
		$this->load->view('student/messages', $data);
        $this->load->view('templates/student_footer');
	}

	/*
	 * DOCU: Displays the list of books available for students.
	 * Loads book data and handles pagination.
	 * Owned by Cherry Ann Nepomuceno
	 */
	public function books()
    {
		$data = $this->get_paginated_data('book_list');
		$data['total_borrowed'] = $this->Student->count_borrow_books();
        
		$this->load->view('templates/student_header');
		$this->load->view('student/books', $data);
        $this->load->view('templates/student_footer');
    }

	/*
	 * DOCU: Handles the search functionality for books.
	 * Redirects to search results based on user input.
	 * Owned by Cherry Ann Nepomuceno
	 */
	public function search()
	{
		$book = $this->input->post('search');
		if(empty($book)){
			redirect('students/books');
		}
		
		$search_results = $this->Student->search_book($book);
		$this->session->set_userdata('search_results', $search_results);
		redirect('students/search_results');
	}

	/*
	 * DOCU: Displays search results for books based on previous search.
	 * Owned by Cherry Ann Nepomuceno
	 */
	public function search_results()
	{
		$search_results = $this->session->userdata('search_results');
		$data = $this->get_paginated_data('search_results', $search_results);
		$data['total_borrowed'] = $this->Student->count_borrow_books();
		$this->load->view('templates/student_header');
		$this->load->view('student/books', $data);
        $this->load->view('templates/student_footer');
	}

	/*
	 * DOCU: Retrieves paginated data for books or search results.
	 * Owned by Cherry Ann Nepomuceno
	 */
	private function get_paginated_data($method, $results = null)
	{
		$result_per_page = 8; 
		$page_number = (int)$this->input->get('page');
        if ($page_number <= 0) {
            $page_number = 1;
        }

		$offset = ($page_number - 1) * $result_per_page;

		if($method == 'search_results'){
			$total_rows = count($results);
			$books = array_slice($results, $offset, $result_per_page);
		} else {
			$total_rows = $this->Student->count_books();
			$books = $this->Admin->get_paginated_books($result_per_page, $offset);
		}

		$number_of_pages = ceil($total_rows / $result_per_page);

        return [
            'books' => $books,
            'current_page' => $page_number,
            'number_of_pages' => $number_of_pages
        ];
	}

	/*
	 * DOCU: Displays currently borrowed books for the student.
	 * Owned by Cherry Ann Nepomuceno
	 */
	public function borrowed_books()
	{	
		$data['borrows'] = $this->Student->currently_borrowed_books();
	
		$this->load->view('templates/student_header');
		$this->load->view('student/borrowed_books', $data);
        $this->load->view('templates/student_footer');
	}

	/*
	* DOCU: Processes the borrowing of a book.
	* Owned by Cherry Ann Nepomuceno
	*/
	public function process_borrow_book()
	{
		$book_id = $this->input->post('book_id'); 

		if ($book_id) {
			$this->Student->borrow_book($book_id);
			$this->session->set_flashdata('sent', 'Your book request has been sent to the admin!');
		}
		
		redirect('students/books'); 
	}

	/*
    * DOCU: Processes the renewal of a borrowed book.
    * Checks if the book has been returned; if so, sets an error message 
    * and redirects. If not, renews the book and sets a success message 
    * Owned by Cherry Ann
	*/
	public function process_renew_book()
	{
		$book_id = $this->input->post('book_id');

		// Check if a return has been processed for this book
		if ($this->Student->is_book_returned($book_id)) {
				$this->session->set_flashdata('error', 'Cannot renew the book because it has already been returned.');
				redirect('students/borrowed_books');
			}

		$this->Student->renew_book($book_id);
		$this->session->set_flashdata('success', 'Are you sure you want to renew this book?.');
		 
		redirect('students/borrowed_books');			
	}

	/*
	* DOCU: Processes the return of a borrowed book.
	* Owned by Cherry Ann Nepomuceno
	*/
	public function process_return_book()
	{
		$book_id = $this->input->post('book_id');
		$this->Student->return_book($book_id);
		redirect('students/borrowed_books');
	}

	/*
	 * DOCU: Displays previously borrowed books with pagination.
	 * Owned by Cherry Ann Nepomuceno
	 */
	public function previously_borrowed_books($page = 1)
	{	
		$limit = 8; // Number of records per page
        $offset = ($page - 1) * $limit;

		// Fetch records for the current page
        $data['previously_borrowed'] = $this->Student->get_previously_borrowed_books($limit, $offset);

		// Calculate total number of records and pages
        $total_previously_borrowed = $this->Student->get_previously_borrowed_book_count();
        $total_pages = ceil($total_previously_borrowed / $limit);

		// Pass pagination data to the view
        $data['pagination'] = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'base_url' => base_url('students/previously_borrowed_books'),
        ];

		// Load view with pagination data
		$this->load->view('templates/student_header');
		$this->load->view('student/previously_borrowed', $data);
        $this->load->view('templates/student_footer');
	}

}



