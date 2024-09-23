

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

});