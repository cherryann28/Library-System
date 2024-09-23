<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin');
        $this->load->model('User');
        $this->load->library('session'); 
      
        // Check if the user is logged in and is an admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('user_level') != 'admin') {
            redirect('login'); 
        }
    }

    /*
    * DOCU: This function is to display home page.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function index()
    {
        $this->load->view('admin/index'); 
    }

    /*
    * DOCU: This function is to display Send a message page.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function messenger()
    {
        $this->load->view('templates/header');
        $this->load->view('admin/messenger');
        $this->load->view('templates/footer');
    }
    
    /*
    * DOCU: This function processes sending a message and validates the input.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function process_message()
    {
        $message = $this->Admin->validate_message($this->input->post());
        
        if($message == 'success')
        {
            $this->Admin->add_message($this->input->post());
            $success[] = "Message Sent!";
            $this->session->set_flashdata('success', $success);
            redirect('admins/messenger');
            
        }
        else
        {
            $errors = array(
                'school_id' => form_error('school_id'),
                'content' => form_error('content'),
            );  
            $this->session->set_flashdata($errors);
            redirect('admins/messenger');
        }
    }

    /*
    * DOCU: This function is to display a list of students from the view file.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function student_list()
    {
        $pagination_data = $this->get_paginated_student_data('students'); 
        $data['students'] = $pagination_data['students'];  
        $data['current_page'] = $pagination_data['current_page']; 
        $data['number_of_pages'] = $pagination_data['number_of_pages']; 
        
        $this->load->view('templates/header');
        $this->load->view('admin/student_list', $data);
        $this->load->view('templates/footer');
    }
    
    /*
    * DOCU: This function processes the search for students.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function process_search_student()
    {
        $student = $this->input->post('search'); 
        if(empty($student)){
            redirect('admins/student_list');
        }

        $search_results = $this->Admin->search_student($student); 
        $this->session->set_userdata('search_results', $search_results); 
        redirect('admins/student_search_results'); 
    }

    /*
    * DOCU: Function to display search results for students
    * Owned by Cherry Ann Nepomuceno 
    */
    public function student_search_results()
    {
        $search_results = $this->session->userdata('search_results'); 
        $data = $this->get_paginated_student_data('search_results', $search_results);
        $this->load->view('templates/header.php');
        $this->load->view('admin/student_list', $data);
        $this->load->view('templates/footer.php');

    }
 
    /*
    * DOCU: This function gets paginated student data based on method type.
    * Owned by Cherry Ann Nepomuceno 
    */
    private function get_paginated_student_data($method, $results = null)
    {
        $result_per_page = 8; // Number of records per page
        $page_number = (int) $this->input->get('page'); // Get current page number
        if ($page_number <= 0) {
            $page_number = 1;   // Default to first page
        }

        $offset = ($page_number - 1) * $result_per_page; // Calculate offset

        if ($method == 'search_results') {
            $total_rows = count($results); // Get total rows for search results
            $students = array_slice($results, $offset, $result_per_page); // Slice results for pagination
        } else {
            $total_rows = $this->Admin->count_users(); // Count total students
            $students = $this->Admin->get_paginated_users($result_per_page, $offset); // Get paginated students
        }

        $number_of_pages = ceil($total_rows / $result_per_page);  // Calculate number of pages

        return [
            'students' => $students,
            'current_page' => $page_number,
            'number_of_pages' => $number_of_pages
        ];
    }

    /*
    * DOCU: This function displays a list of books with pagination.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function book_list()
    {
        $data = $this->get_paginated_data('book_list'); 
        $this->load->view('templates/header.php'); 
        $this->load->view('admin/book_list', $data);
        $this->load->view('templates/footer.php'); 
    }

    /*
    * DOCU: This function processes the search for books.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function process_search_book()
    {
        $book = $this->input->post('search'); 
        if (empty($book)) {
            redirect('admins/book_list');
        }

        $searchResults = $this->Admin->search_book($book); 
        $this->session->set_userdata('search_results', $searchResults); 
        redirect('admins/search_results'); 
    }

    /*
    * DOCU: This function displays search results for books.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function search_results()
    {   
        $searchResults = $this->session->userdata('search_results'); 
        $data = $this->get_paginated_data('search_results', $searchResults); 
        $this->load->view('templates/header.php');
        $this->load->view('admin/book_list', $data);
        $this->load->view('templates/footer.php');
    }

    /*
    * DOCU: This function gets paginated data based on method type.
    * Owned by Cherry Ann Nepomuceno 
    */
    private function get_paginated_data($method, $results = null)
    {
        $result_per_page = 8; // Fixed number of results per page
        $page_number = (int)$this->input->get('page'); // Get current page number
        if ($page_number <= 0) {
            $page_number = 1; // Default to first page
        }

        $offset = ($page_number - 1) * $result_per_page; // Calculate offset
        
        if ($method == 'search_results') {
            $total_rows = count($results); // Get total rows for search results
            $books = array_slice($results, $offset, $result_per_page); // Slice results for pagination
        } else {
            $total_rows = $this->Admin->count_books(); // Count total books
            $books = $this->Admin->get_paginated_books($result_per_page, $offset); // Get paginated books
        }

        $number_of_pages = ceil($total_rows / $result_per_page); // Calculate number of pages

        return [
            'books' => $books,
            'current_page' => $page_number,
            'number_of_pages' => $number_of_pages
        ];
    }

    /*
    * DOCU: This function is to display a form that allows an admin to update a book's details.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function edit($id)
    {
        $data['book'] = $this->Admin->get_book_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('admin/update', $data);
        $this->load->view('templates/footer');
        
    }

    /*
    * DOCU: This function is to process the form submitted from the edit to update that particular book's 
    * details. If input fields are left blank it will promt an error; else, it will successfully updated
    * Owned by Cherry Ann Nepomuceno 
    */
    public function process_update($id)
    {
        $update_book = $this->Admin->validate_update_book($this->input->post());
        
        if($update_book == 'success')
        {
            $this->Admin->update_book($this->input->post());
            $success[] = "Updated successfully!";
            $this->session->set_flashdata('success', $success);
            redirect('book_list');
        }
        else
        {
            $errors = array(
                'accesion' => form_error('accesion'),
                'title' => form_error('title'),
                'publisher' => form_error('publisher'),
                'year' => form_error('year'),
                'availability' => form_error('availability'),
            );  
            $this->session->set_flashdata($errors);
            redirect('admins/edit/' . $id);
        }
    }

    /*
    * DOCU: This function displays the add book form.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function add_book()
    {
        $this->load->view('templates/header.php');
        $this->load->view('admin/add_books');
        $this->load->view('templates/footer.php');
    }

    /*
    * DOCU: This function processes the addition of a new book.
    * Owned by Cherry Ann Nepomuceno 
    */
    public function process_add_book()
    {
        $add_book = $this->Admin->validate_add_book($this->input->post()); 
        
        if($add_book == 'success')
        {
            $this->Admin->add_book($this->input->post());
            $success[] = "Successfully added new book!";
            $this->session->set_flashdata('success', $success);
            redirect('admins/add_book');
        }
        else
        {
            $errors = array(
                'accesion' => form_error('accesion'),
                'title' => form_error('title'),
                'publisher' => form_error('publisher'),
                'year' => form_error('year'),
                'availability' => form_error('availability'),
            );  
            $this->session->set_flashdata($errors);
            redirect('admins/add_book');
        }
    }

    /*
    * DOCU: This function displays the issue request page with pagination. 
    * Owned by Cherry Ann Nepomuceno 
    */
    public function issue_request($page = 1)
    {
        $limit = 8; // Number of records per page
        $offset = ($page - 1) * $limit;

        // Fetch records for the current page
        $data['records'] = $this->Admin->get_all_records($limit, $offset);

        // Calculate total number of records and pages
        $total_records = $this->Admin->count_all_records();
        $total_pages = ceil($total_records / $limit);

        // Pass pagination data to the view 
        $data['pagination'] = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'base_url' => base_url('admins/issue_request'),
        ];

        // Load view with pagination data
        $this->load->view('templates/header');
        $this->load->view('admin/issue_request', $data);
        $this->load->view('templates/footer');
    }

    /*
    * DOCU: This function processes the acceptance of an issued book request.
    * It retrieves necessary data from the POST request, updates the corresponding
    * record to indicate acceptance, decrements the book's availability count, 
    * and sends a notification message to the student. 
    * Owned by Cherry Ann Nepomuceno 
    */
    public function process_issue_request()
    {
          // Retrieve POST data
        $record_id = $this->input->post('record_id');
        $book_id = $this->input->post('book_id');
        $student_id = $this->input->post('student_id');

            // Process the data
        $this->Admin->accept_book_student($record_id);
        $this->Admin->availability($book_id);
        $this->Admin->messenger($student_id);

        // Redirect after processing
        redirect('admins/issue_request');
        
    }

    /*
    * DOCU: This function retrieves and displays the decline records.
    * Owned by Cherry Ann Nepomuceno
    */
    public function decline()
    {
        $data['records'] = $this->Admin->get_all_records();
        $this->load->view('templates/header');
        $this->load->view('admin/decline', $data);
        $this->load->view('templates/footer');
    }
    
    /*
    * DOCU: This function processes the decline of an issued book request.
    * It retrieves necessary data from the POST request, deletes the corresponding
    * record from the database, sends a notification message to the student.
    * Owned by Cherry Ann Nepomuceno
    */
    public function process_decline()
    {
         // Retrieve POST data
        $record_id = $this->input->post('record_id');
        $student_id = $this->input->post('student_id');

        // Process the data
        $this->Admin->decline_borrow_book($record_id);
        $this->Admin->decline_message($student_id);
        
         // Redirect after processing
         redirect('admins/issue_request');
    }

    /*
    * DOCU: This function displays renewal requests with pagination.
    * Owned by Cherry Ann Nepomuceno
    */
    public function renew_request($page = 1)
    {
        $limit = 8; // Number of records per page
        $offset = ($page - 1) * $limit;

        // Fetch records for the current page
        $data['renews'] = $this->Admin->get_all_renew($limit, $offset);

        // Calculate total number of records and pages
        $total_renew = $this->Admin->count_all_renew();
        $total_pages = ceil($total_renew / $limit);

        // Pass pagination data to the view
        $data['pagination'] = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'base_url' => base_url('admins/renew_request'),
        ];

        // Load view with pagination data
        $this->load->view('templates/header');
        $this->load->view('admin/renew_request', $data);
        $this->load->view('templates/footer');
    }

    /*
    * DOCU: This function processes the renewal of a book for a student.
    * It updates the renewal status,
    * deletes the renewal request, and sends a confirmation message to the student.
    * Owned by Cherry Ann Nepomuceno
    */
    public function process_student_renewal()
    {
        // Retrieve POST data
        $record_id = $this->input->post('record_id');
        $student_id = $this->input->post('student_id');
        $book_id = $this->input->post('book_id');
        $renew_id = $this->input->post('renew_id');
       
        // Call the model method to handle the renewal process
        $this->Admin->accept_renew_book($record_id,$student_id, $book_id, $renew_id);
        $this->Admin->delete_renew_book($renew_id, $student_id, $book_id);
        $this->Admin->renew_message($student_id);

        // Redirect after processing
        redirect('admins/renew_request');
    }

    /*
    * DOCU: This function handles the display of return requests with pagination.
    * Owned by Cherry Ann Nepomuceno
    */
    public function return_request($page = 1)
    {
        $limit = 8; // Number of records per page
        $offset = ($page - 1) * $limit; // Calculate the offset 

        // Fetch records for the current page
        $data['returns'] = $this->Admin->get_all_return($limit, $offset);

        // Calculate total number of records and pages
        $total_return = $this->Admin->count_all_return();
        $total_pages = ceil($total_return / $limit);

        // Pass pagination data to the view
        $data['pagination'] = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'base_url' => base_url('admins/return_request'),
        ];

        // Load view with pagination data
        $this->load->view('templates/header');
        $this->load->view('admin/return_request', $data);
        $this->load->view('templates/footer');
    }

    /*
    * DOCU: This function processes the return of a book by a student.
    * Owned by Cherry Ann Nepomuceno
    */
    public function process_return()
    {
        // Retrieve POST data
        $record_id = $this->input->post('record_id');
        $book_id = $this->input->post('book_id');
        $return_id = $this->input->post('return_id');
        $student_id = $this->input->post('student_id');

       // Process the data
        $this->Admin->accept_return_book($record_id, $book_id, $student_id);
        $this->Admin->return_availability($book_id);
        $this->Admin->delete_return_book($return_id, $student_id, $book_id);
        $this->Admin->return_message($student_id);

        // Redirect after processing
        redirect('admins/return_request');   
    }


     /*
    * DOCU: This function displays currently issued books with pagination.
    * Owned by Cherry Ann Nepomuceno
    */
    public function currently_issued_books()
    {
        $result_per_page = 8; 
        $page_number = (int)$this->input->get('page'); 
        if($page_number <= 0){
            $page_number = 1; 
        }

        $offset = ($page_number - 1) * $result_per_page; 
        $total_rows = $this->Admin->count_currently_issued_books(); 
        $number_of_pages = ceil($total_rows / $result_per_page); 
        
        $data['currently_issued_books'] = $this->Admin->get_paginated_currently_issued_books($result_per_page, $offset); 
        $data['current_page'] = $page_number; 
        $data['number_of_pages'] = $number_of_pages; 

        $this->load->view('templates/header.php');
        $this->load->view('admin/currently_issued_books', $data);
        $this->load->view('templates/footer.php');

    }

}

