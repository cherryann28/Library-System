<?php 
    $current_page = isset($current_page) ? $current_page : 1;
    $number_of_pages = isset($number_of_pages) ? $number_of_pages : 1;
?>

        <div class="data">
<?php       if (!empty($currently_issued_books)): ?>
            <h2>Currently Issued Books</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Accesion</th>
                        <th>Book Name</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Dues</th>
                    </tr>
                </thead>
                <tbody>
<?php
                foreach($currently_issued_books as $row){
?>
                    <tr>
                    <td><?= htmlspecialchars($row['school_id']) ?></td>
                    <td><?= htmlspecialchars($row['accesion']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['date_of_issue']) ?></td>
                    <td><?= htmlspecialchars($row['due_date']) ?></td>
                        <td>
<?php               if ($row['dues'] > 0): ?>
                        <font color='red'><?= htmlspecialchars($row['dues']) ?></font>
<?php              else: ?>
                        <font color='green'>0</font>
<?php               endif; ?>
                        </td>
                    </tr>
<?php           }   ?>
                </tbody>
            </table>  
<?php   else: ?>
            <p class="no_found">No currently issued books.</p>
<?php   endif; ?> 




            <!-- Pagination Links -->
            <div class="pagination">
<?php           if ($current_page > 1): ?>
                    <a class="previous" href="<?= base_url('admins/currently_issued_books?page=' . ($current_page - 1)) ?>">Previous</a>
<?php           endif; ?>

<?php           for ($page = 1; $page <= $number_of_pages; $page++): ?>
<?php               if ($page == $current_page): ?>
                        <strong><?= $page ?></strong>
<?php               else: ?>
                        <a href="<?= base_url('admins/currently_issued_books?page=' . $page) ?>"><?= $page ?></a>
<?php               endif; ?>
<?php           endfor; ?>

<?php           if ($current_page < $number_of_pages): ?>
                    <a class="next" href="<?= base_url('admins/currently_issued_books?page=' . ($current_page + 1)) ?>">Next</a>
<?php           endif; ?>
            </div> 
		</div>
        
