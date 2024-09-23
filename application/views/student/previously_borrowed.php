

<?php 
    $current_page = isset($current_page) ? $current_page : 1;
    $number_of_pages = isset($number_of_pages) ? $number_of_pages : 1;
   
?>
        <div class="data">
<?php       if (!empty($previously_borrowed)): ?>
            <h2>Previously Issued Books</h2>
            <table>
                <thead>
                    <tr>
                        <th>Accesion</th>
                        <th>Title</th>
                        <th>Issued Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
<?php               foreach($previously_borrowed as $borrowed): ?>
                        <tr>
                            <td><?= htmlspecialchars($borrowed['accesion']) ?></td>
                            <td><?= htmlspecialchars($borrowed['title']) ?></td>
                            <td><?= htmlspecialchars($borrowed['date_of_issue']) ?></td>
                            <td><?= htmlspecialchars($borrowed['date_of_return']) ?></td>
                        </tr>
<?php               endforeach; ?>
                </tbody>
            </table>    
<?php   else: ?>
            <p class="no_found">No previously borrowed books.</p>
<?php   endif; ?>


            <!-- Pagination Links -->
            <div class="pagination">
<?php           if ($pagination['current_page'] > 1): ?>
                    <a class="previous" href="<?= $pagination['base_url'] ?>/<?= $pagination['current_page'] - 1 ?>">Previous</a>
<?php           endif; ?>

<?php           for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <a href="<?= $pagination['base_url'] ?>/<?= $i ?>" <?= ($pagination['current_page'] == $i) ? 'class="active"' : '' ?>><?= $i ?></a>
<?php           endfor; ?>

<?php           if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <a class="next" href="<?= $pagination['base_url'] ?>/<?= $pagination['current_page'] + 1 ?>">Next</a>
<?php           endif; ?>
            </div>
        </div>
   