
        <p><?= $this->session->flashdata('sent')?></p>
        <div class="data">
<?php       if (!empty($returns)): ?>
            <h2>Return Requests</h2>
            <table>
                <thead>
                    <tr>
                       <th>Student ID</th>
                       <th>Accesion</th>
                       <th>Book Name</th>
                       <th>Dues</th>
                       <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
                foreach($returns as $return) {
?>
                    <tr>
                        <td><?= htmlspecialchars($return['school_id']) ?></td>
                        <td><?= htmlspecialchars($return['accesion']) ?></td>
                        <td><?= htmlspecialchars($return['title']) ?></td>
                        <td>
<?php                       if ($return['dues'] > 0): ?>
                                <font color='red'><?= htmlspecialchars($return['dues']) ?></font>
<?php                       else: ?>
                                <font color='green'>0</font>
<?php                       endif; ?>
                        </td>
                        <td>
                        <a id="return" href="#" class="open-accept-return-modal" 
                            data-record-id="<?= $return['record_id'] ?>" 
                            data-book-id="<?= $return['book_id'] ?>" 
                            data-return-id="<?= $return['return_id'] ?>"
                            data-student-id="<?= $return['school_id'] ?>">
                            Accept
                        </a>
                        </td>
                    </tr>
<?php               }   ?>
                </tbody>
            </table>  
<?php else: ?>
        <p class="no_found">No return requests.</p>
<?php endif; ?>   



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


        
        <!-- Accept Return Modal HTML -->
        <div id="acceptReturnModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Confirm Accept</h2>
                <p>Are you sure you want to accept this return request?</p>
                <form id="acceptReturnForm" action="<?= base_url('admins/process_return') ?>" method="post">
                    <input type="hidden" name="record_id" id="accept_record_id" value="">
                    <input type="hidden" name="book_id" id="accept_book_id" value="">
                    <input type="hidden" name="return_id" id="accept_return_id" value="">
                    <input type="hidden" name="student_id" id="accept_student_id" value="">
                    <button type="submit" class="btn">Yes, Accept</button>
                    <button type="button" class="btn close-accept-return-btn">Cancel</button>
                </form>
            </div>
        </div>  
   