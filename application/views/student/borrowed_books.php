
<?php
echo "Flashdata error: " . $this->session->flashdata('error'); // For debugging
?>
        

    <div class="data">
<?php   if (!empty($borrows)): ?>
            <h2>Borrowed Books</h2>
            <p><?= $this->session->flashdata('sent')?></p>
        <div class="borrowed_books">
            <table>
                <thead>
                    <tr>
                        <th>Accesion</th>
                        <th>Title</th>
                        <th>Issued Date</th>
                        <th>Due Date</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php               foreach($borrows as $borrow): ?>
                        <tr>
                            <td><?= htmlspecialchars($borrow['accesion']) ?></td>
                            <td><?= htmlspecialchars($borrow['title']) ?></td>
                            <td><?= htmlspecialchars($borrow['date_of_issue']) ?></td>
                            <td><?= htmlspecialchars($borrow['due_date']) ?></td>
                                <!-- Renew Button Cell -->
                            <td>
<?php                           if ($borrow['renewal_status'] == 'pending'): ?>
                                    <span>Renewal Pending</span>
<?php                           elseif ($borrow['renewal_status'] == 'none' || $borrow['renewal_status'] == 'approved'): ?>
<?php                               if ($borrow['renewals_left'] > 0): ?>
                                        <button class="open-renew-modal" data-book-id="<?= $borrow['book_id'] ?>">Renew</button>
<?php                               else: ?>
                                        <span>No Renewals Left</span>
<?php                               endif; ?>
<?php                           endif; ?>
                            </td>
                                <!-- Return Button Cell -->                            
                            <td>
                                <?php if ($borrow['renewal_status'] == 'none' || $borrow['renewal_status'] == 'approved'): ?>
                                    <button class="open-return-modal" data-book-id="<?= $borrow['book_id'] ?>">Return</button>
                                <?php endif; ?>
                            </td>
                        </tr>
<?php               endforeach; ?>  
                </tbody>
            </table>    
<?php   else: ?>
            <p class="no_found">No borrowed books.</p>
<?php   endif; ?>
		</div>    
        

    <!-- Renew Book Modal HTML -->
    <div id="renewBookModal" class="modal">
        <div class="modal-content">
            <span class="close-renew">&times;</span>
            <h2>Renew Book</h2>

            <?php if ($this->session->flashdata('error')): ?>
                <p class="error-message" style="color: red;"><?= $this->session->flashdata('error') ?></p>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <p class="success-message" style="color: red;"><?= $this->session->flashdata('success') ?></p>
            <?php endif; ?>
            
            <p>Are you sure you want to renew this book?</p>
            <form id="renewBookForm" action="<?= base_url('students/process_renew_book') ?>" method="post">
                <input type="hidden" name="book_id" id="renew_book_id" value="">
                <button type="submit" class="btn">Yes, Renew</button>
                <button type="button" class="btn close-renew-btn">Cancel</button>
            </form>
        </div>
    </div>

            <!-- Return Book Modal HTML -->
    <div id="returnBookModal" class="modal">
        <div class="modal-content">
            <span class="close-return">&times;</span>
            <h2>Return Book</h2>
            <p>Are you sure you want to return this book?</p>
            <form id="returnBookForm" action="<?= base_url('students/process_return_book') ?>" method="post">
                <input type="hidden" name="book_id" id="return_book_id" value="">
                <button type="submit" class="btn">Yes, Return</button>
                <button type="button" class="btn close-return-btn">Cancel</button>
            </form>
        </div>
    </div>


            