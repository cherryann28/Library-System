
        <div class="data">
<?php       if (!empty($renews)): ?>
                <h2>Renew Requests</h2>
                <table>
                    <thead>
                        <tr>
                        <th>Student ID</th>
                        <th>Accesion</th>
                        <th>Book Name</th>
                        <th>Renewals Left</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php                   foreach ($renews as $renew): ?>
                            <tr>
                                <td><?= $renew['school_id'] ?></td>
                                <td><?= $renew['accesion'] ?></td>
                                <td><?= $renew['title'] ?></td>
                                <td><?= $renew['renewals_left'] ?></td>
                                <td>
<?php                               if ($renew['renewals_left'] > 0 && ($renew['user_level'] == 'faculty' || $renew['user_level'] == 'student')): ?>
                                        <a id="renew" href="#" class="open-accept-renew-modal" 
                                            data-record-id="<?= $renew['record_id'] ?>" 
                                            data-student-id="<?= $renew['school_id'] ?>" 
                                            data-book-id="<?=$renew['book_id']?>" 
                                            data-renew-id="<?= $renew['renew_id'] ?>" 
                                        >Accept</a>
<?php                               endif; ?>
                                </td>
                            </tr>
<?php                   endforeach; ?>

                    </tbody>
                </table>    
<?php       else: ?>
                <p class="no_found">No renewal requests.</p>
<?php       endif; ?> 



             <!-- Debugging Pagination Data -->
             <!-- <p>Current Page: <?= $pagination['current_page'] ?></p>
            <p>Total Pages: <?= $pagination['total_pages'] ?></p>
            <p>Base URL: <?= $pagination['base_url'] ?></p> -->

            
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
  
    
        <!-- Accept Renew Modal HTML -->
        <div id="acceptRenewModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Confirm Accept</h2>
                <p>Are you sure you want to accept this renew request?</p>
                <form id="acceptRenewForm" action="<?= base_url('admins/process_student_renewal') ?>" method="post">
                    <input type="hidden" name="record_id" id="accept_record_id" value="">
                    <input type="hidden" name="student_id" id="accept_student_id" value="">
                    <input type="hidden" name="book_id" id="accept_book_id" value="">
                    <input type="hidden" name="renew_id" id="accept_renew_id" value="">
                    <button type="submit" class="btn">Yes, Accept</button>
                    <button type="button" class="btn close-accept-renew-btn">Cancel</button>
                </form>
            </div>
        </div>  
   