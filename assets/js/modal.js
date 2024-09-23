

document.addEventListener('DOMContentLoaded', function() {
    var acceptModal = document.getElementById('acceptModal');
    var declineModal = document.getElementById('declineModal');
    var acceptLinks = document.querySelectorAll('.open-accept-modal');
    var declineLinks = document.querySelectorAll('.open-decline-modal');

    // Open Accept Modal
    acceptLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('record_id').value = this.getAttribute('data-record-id');
            document.getElementById('book_id').value = this.getAttribute('data-book-id');
            document.getElementById('student_id').value = this.getAttribute('data-student-id');
            acceptModal.style.display = 'block';
        });
    });

    // Open Decline Modal
    declineLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('decline_record_id').value = this.getAttribute('data-record-id');
            document.getElementById('decline_student_id').value = this.getAttribute('data-student-id');
            declineModal.style.display = 'block';
        });
    });

    // Close Modals
    document.querySelectorAll('.close, .close-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            acceptModal.style.display = 'none';
        });
    });

    document.querySelectorAll('.close, .close-decline-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            declineModal.style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target == acceptModal) {
            acceptModal.style.display = 'none';
        }   
        if (event.target == declineModal) {
            declineModal.style.display = 'none';
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    var acceptReturnModal = document.getElementById('acceptReturnModal');
    var acceptReturnLinks = document.querySelectorAll('.open-accept-return-modal');

    // Open Accept Return Modal
    acceptReturnLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('accept_record_id').value = this.getAttribute('data-record-id');
            document.getElementById('accept_book_id').value = this.getAttribute('data-book-id');
            document.getElementById('accept_return_id').value = this.getAttribute('data-return-id');
            document.getElementById('accept_student_id').value = this.getAttribute('data-student-id');
            acceptReturnModal.style.display = 'block';
        });
    });

    // Close Accept Return Modal
    document.querySelectorAll('.close, .close-accept-return-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            acceptReturnModal.style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target == acceptReturnModal) {
            acceptReturnModal.style.display = 'none';
        }
    });
});


// Accept Modal
document.addEventListener('DOMContentLoaded', function() {
    var acceptRenewModal = document.getElementById('acceptRenewModal');
    var acceptRenewLinks = document.querySelectorAll('.open-accept-renew-modal');

    // Open Accept Return Modal
    acceptRenewLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('accept_record_id').value = this.getAttribute('data-record-id');
            document.getElementById('accept_student_id').value = this.getAttribute('data-student-id');
            document.getElementById('accept_book_id').value = this.getAttribute('data-book-id');
            document.getElementById('accept_renew_id').value = this.getAttribute('data-renew-id');
            acceptRenewModal.style.display = 'block';
        });
    });

    // Close Accept Return Modal
    document.querySelectorAll('.close, .close-accept-renew').forEach(function(element) {
        element.addEventListener('click', function() {
            acceptRenewModal.style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target == acceptRenewModal) {
            acceptRenewModal.style.display = 'none';
        }
    });
});

// Issue Modal
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("issueModal");
    var span = document.getElementsByClassName("close")[0];
    var closeBtns = document.getElementsByClassName("close-btn");
    var issueButtons = document.querySelectorAll('.borrow');
    var bookIdField = document.getElementById('book_id');

    issueButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            var bookId = this.getAttribute('data-book-id');
            bookIdField.value = bookId;
            modal.style.display = "block";
        });
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    Array.from(closeBtns).forEach(function(btn) {
        btn.onclick = function() {
            modal.style.display = "none";
        }
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});


// Return and Renew Modal
document.addEventListener('DOMContentLoaded', function() {
    var returnBookModal = document.getElementById('returnBookModal');
    var renewBookModal = document.getElementById('renewBookModal');
    var returnLinks = document.querySelectorAll('.open-return-modal');
    var renewLinks = document.querySelectorAll('.open-renew-modal');
    // Check for error message in session and log it
    console.log("Error Message: ", "<?= $this->session->flashdata('error') ?>");


    // Open Return Book Modal
    returnLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('return_book_id').value = this.getAttribute('data-book-id');
            returnBookModal.style.display = 'block';
        });
    });

    // Open Renew Book Modal
    renewLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('renew_book_id').value = this.getAttribute('data-book-id');
            renewBookModal.style.display = 'block';

            // Check if there's a flash message
            var errorMessage = "<?= $this->session->flashdata('error') ?>";
            if (errorMessage) {
                document.querySelector('.error-message').innerText = errorMessage;
            }

            var successMessage = "<?= $this->session->flashdata('success') ?>";
            if (successMessage) {
                document.querySelector('.success-message').innerText = successMessage;
            }
        });
    });

    // Close Return Book Modal
    document.querySelectorAll('.close-return, .close-return-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            returnBookModal.style.display = 'none';
        });
    });

    // Close Renew Book Modal
    document.querySelectorAll('.close-renew, .close-renew-btn').forEach(function(element) {
        element.addEventListener('click', function() {
            renewBookModal.style.display = 'none';
        });
    });

    // Close Modals when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target == returnBookModal) {
            returnBookModal.style.display = 'none';
        }
        if (event.target == renewBookModal) {
            renewBookModal.style.display = 'none';
        }
    });

});