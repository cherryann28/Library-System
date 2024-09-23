<?php 
    $current_page = isset($current_page) ? $current_page : 1;
    $number_of_pages = isset($number_of_pages) ? $number_of_pages : 1;
?>

        <div class="data">
            <div class="search">
                <form action="<?= base_url()?>admins/process_search_book" method="post">
                    <input type="text" placeholder="Search Book's title" name="search">
                </form>
            </div>
<?php
    $this->load->view('partials/flash_messages');
?>
<?php   if (!empty($books)): ?>
            <h2>Book List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Accesion</th>
                        <th>Title</th>
                        <th>Publisher</th>
                        <th>Year</th>
                        <th>Availability</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php               foreach ($books as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars(ucfirst($row['accesion'])) ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['title'])) ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['publisher'])) ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['year'])) ?></td>
                            <td><center><?= htmlspecialchars(ucfirst($row['availability'])) ?></center></td>
                            <td><a id="edit" href="<?= base_url('admins/edit');?>/<?= $row['id']?>">Edit</a></td>
                        </tr>
<?php               endforeach; ?>
                </tbody>
            </table>   
<?php   else: ?>
            <p class="no_found">No books found.</p>
<?php   endif; ?>   
        



            <!-- Pagination Links -->
            <div class="pagination">
<?php           if ($current_page > 1): ?>
                    <a class="previous" href="<?= base_url('book_list?page=' . ($current_page - 1)) ?>">Previous</a>
<?php           endif; ?>

<?php           for ($page = 1; $page <= $number_of_pages; $page++): ?>
<?php               if ($page == $current_page): ?>
                        <strong class="active"><?= $page ?></strong>
<?php               else: ?>
                        <a href="<?= base_url('book_list?page=' . $page) ?>"><?= $page ?></a>
<?php               endif; ?>
<?php           endfor; ?>

<?php           if ($current_page < $number_of_pages): ?>
                    <a class="next" href="<?= base_url('book_list?page=' . ($current_page + 1)) ?>">Next</a>
<?php           endif; ?>
            </div>
        </div>

    
    