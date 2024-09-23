

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