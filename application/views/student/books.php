


<?php 
    $current_page = isset($current_page) ? $current_page : 1;
    $number_of_pages = isset($number_of_pages) ? $number_of_pages : 1;  
?>
    <div class="data">
        <div class="search">
            <form action="<?= base_url()?>students/search" method="post">
                <input type="text" placeholder="Search Book's title" name="search">
            </form>
        </div>

<?php       if (!empty($books)): ?>
            <h2>Books</h2>
            <table>
                <thead>
                    <tr>
                        <th>Accesion</th>
                        <th>Title</th>
                        <th>Publisher</th>
                        <th>Year</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>  
<?php               foreach($books as $row): ?>
                    <tr>
                        <td><?= $row['accesion'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['publisher'] ?></td>
                        <td><?= $row['year'] ?></td>
                        <td>    
<?php                       if($row['availability'] > 0): ?>
                                <p class='green'>Available</p>
<?php                       else: ?>
                                <p class='red'>Borrowed</p>
<?php                       endif; ?>
                        </td>
                        <td>
<?php                       if($row['availability'] > 0): ?>
<?php                           if($total_borrowed['count'] < 5): ?>
                                    <a class="borrow" href="#" data-book-id="<?= $row['id'] ?>">Issue</a>
<?php                           else: ?>
                                    <a class="borrow" href="">Issue</a>
<?php                           endif; ?>
<?php                       else: ?>
                                <!-- No button displayed if the book is borrowed --> <p class="no_available">0</p>
<?php                       endif; ?>
                        </td>
                    </tr>
<?php               endforeach; ?>
                </tbody>
            </table>  
<?php       else: ?>
                <p class="no_found">No books found.</p>
<?php       endif; ?>


        
        <!-- Pagination Links -->
        <div class="pagination">
<?php       if ($current_page > 1): ?>
                <a class="previous" href="<?= base_url('books?page=' . ($current_page - 1)) ?>">Previous</a>
<?php       endif; ?>

<?php       for ($page = 1; $page <= $number_of_pages; $page++): ?>
<?php           if ($page == $current_page): ?>
                    <strong><?= $page ?></strong>
<?php           else: ?>
                    <a href="<?= base_url('books?page=' . $page) ?>"><?= $page ?></a>
<?php           endif; ?>
<?php       endfor; ?>

<?php       if ($current_page < $number_of_pages): ?>
                <a class="next" href="<?= base_url('books?page=' . ($current_page + 1)) ?>">Next</a>
<?php       endif; ?>
        </div>
    </div>



    <!-- Modal HTML -->
    <div id="issueModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Book Issue</h2>
            <p>Are you sure you want to issue this book?</p>
            <form id="issueForm" action="<?= base_url('students/process_borrow_book') ?>" method="post">
                <input type="hidden" name="book_id" id="book_id" value="">
                <button type="submit" class="btn">Yes, Issue</button>
                <button type="button" class="btn close-btn">Cancel</button>
            </form> 
        </div>
    </div>


    <!-- <a href="#" id="issueButton" onclick="issueBook(); return false;">Issue</a>

    <script>
    function issueBook() {
        var button = document.getElementById('issueButton');
        button.disabled = true; // Disable the button
        // Perform AJAX call to issue the book
    }
    </script> -->









