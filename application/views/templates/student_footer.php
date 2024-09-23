</div>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {
    // Function to activate the correct menu item based on the current URL
    function activateCurrentMenu() {
        var currentPath = window.location.pathname.split('/').pop();
        $('#menu li').each(function() {
            var link = $(this).find('a').attr('href').split('/').pop();
            if (link === currentPath) {
                $(this).addClass('active');
            }
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
    // if ($('#menu').length) {
    //         console.log('Menu is present and ready.');
    //     } else {
    //         console.log('Menu not found.');
    // }


});


</script>


<script>
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
</script>


<script>
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

</script>