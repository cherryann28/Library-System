</div>
 <!-- Bootstrap JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {  
    // Function to activate the correct menu item based on the current URL
    function activateCurrentMenu() {
        var currentPath = window.location.pathname.split('/').pop();
        // console.log("Current Path: ", currentPath); for debug

        $('#menu li').each(function() {
            var link = $(this).find('a').attr('href').split('/').pop();
            // console.log("Link: ", link); for debug

            if (link === currentPath) {
                $(this).addClass('active');
            }
            // if (link === currentPath) {  for debug
            //     $(this).addClass('active');
            // } else {
            //     $(this).removeClass('active');
            // }
        });
    }
    
    // Call the function to set the initial active menu item
    activateCurrentMenu();

    // Handle the active state when clicking on menu items
    $('#menu').on('click', 'li a', function(e) {
        e.preventDefault(); // Prevent default link behavior

        // Remove 'active' class from all <li> elements
        $('#menu li').removeClass('active');            

        // Add 'active' class to the parent <li> of the clicked <a> element
        $(this).closest('li').addClass('active');

        // Navigate to the href of the clicked link
        window.location.href = $(this).attr('href');
    });

// Check if #menu exists before attaching events
if ($('#menu').length) {
        console.log('Menu is present and ready.');
    } else {
        console.log('Menu not found.');
    }


});

</script>

<script>
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

</script>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get modals and close buttons
    var acceptModal = document.getElementById("acceptModal");
    var declineModal = document.getElementById("declineModal");

    var acceptClose = document.getElementsByClassName("close")[0];
    var declineClose = document.getElementsByClassName("close-decline")[0];
    var closeDeclineBtns = document.getElementsByClassName("close-decline-btn");

    // Get action forms
    var actionForm = document.getElementById('actionForm');
    var actionFormDecline = document.getElementById('actionFormDecline');

    // Get open buttons
    var openAcceptButtons = document.querySelectorAll('.open-accept-modal');
    var openDeclineButtons = document.querySelectorAll('.open-decline-modal');  

    // Get input fields
    var recordIdField = document.getElementById('record_id');
    var bookIdField = document.getElementById('book_id');
    var studentIdField = document.getElementById('student_id');
    
    var declineRecordIdField = document.getElementById('decline_record_id');
    var declineStudentIdField = document.getElementById('decline_student_id');

    // Open accept modal
    openAcceptButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var recordId = this.getAttribute('data-record-id');
            var bookId = this.getAttribute('data-book-id');
            var studentId = this.getAttribute('data-student-id');
            
            recordIdField.value = recordId;
            bookIdField.value = bookId;
            studentIdField.value = studentId;
            
            actionForm.action = '<?= base_url('admins/process_accept') ?>';
            acceptModal.style.display = "block";
        });
    });

    // Open decline modal
    openDeclineButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var recordId = this.getAttribute('data-record-id');
            var studentId = this.getAttribute('data-student-id');
            
            declineRecordIdField.value = recordId;
            declineStudentIdField.value = studentId;
            
            actionFormDecline.action = '<?= base_url('admins/process_decline') ?>';
            declineModal.style.display = "block";
        });
    });

    // Close accept modal
    acceptClose.onclick = function() {
        acceptModal.style.display = "none";
    }

    // Close decline modal
    declineClose.onclick = function() {
        declineModal.style.display = "none";
    }

    Array.from(closeDeclineBtns).forEach(function(btn) {
        btn.onclick = function() {
            declineModal.style.display = "none";
        }
    });

    // Close modals when clicking outside of them
    window.onclick = function(event) {
        if (event.target == acceptModal) {
            acceptModal.style.display = "none";
        }
        if (event.target == declineModal) {
            declineModal.style.display = "none";
        }
    }
});
</script -->
 <script>
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

        // document.querySelectorAll('.close-accept-return-btn').forEach(function(btn) {
        //     btn.addEventListener('click', function() {
        //         acceptReturnModal.style.display = 'none';
        //     });
        // });

        window.addEventListener('click', function(event) {
            if (event.target == acceptReturnModal) {
                acceptReturnModal.style.display = 'none';
            }
        });
    });
</script>


<script>
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

        // document.querySelectorAll('.close-accept-renew-btn').forEach(function(btn) {
        //     btn.addEventListener('click', function() {
        //         acceptRenewModal.style.display = 'none';
        //     });
        // });

        window.addEventListener('click', function(event) {
            if (event.target == acceptRenewModal) {
                acceptRenewModal.style.display = 'none';
            }
        });
    });
</script>
