    <div class="data">
<?php   if (!empty($records)): ?>
            <h2>Issue Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Accesion</th>
                        <th>Book</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php               foreach($records as $record): ?>
                        <tr>
                            <td><?= $record['school_id'] ?></td>
                            <td><?= $record['accesion'] ?></td>
                            <td><?= $record['title'] ?></td>
                            <td><?= $record['availability'] ?></td>
                            <td>
                                <?php if ($record['user_level'] == 'faculty' || $record['user_level'] == 'student'): ?>
                                    <a href="#" class="open-accept-modal" data-record-id="<?= $record['id'] ?>" data-book-id="<?= $record['book_id'] ?>" data-student-id="<?= $record['school_id'] ?>">Accept</a>
                                <?php endif; ?>
                                <a href="#" class="open-decline-modal" data-record-id="<?= $record['id'] ?>" data-student-id="<?= $record['school_id'] ?>">Decline</a>
                            </td>
                        </tr>
<?php               endforeach; ?>
                </tbody>
            </table>
<?php   else: ?>
            <p class="no_found">No requests for issuing books.</p>
<?php   endif; ?>



        <!-- Pagination Links -->
        <div class="pagination">
<?php       if ($pagination['current_page'] > 1): ?>
                <a class="previous" href="<?= $pagination['base_url'] ?>/<?= $pagination['current_page'] - 1 ?>">Previous</a>
<?php       endif; ?>
<?php       for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <a href="<?= $pagination['base_url'] ?>/<?= $i ?>" <?= ($pagination['current_page'] == $i) ? 'class="active"' : '' ?>><?= $i ?></a>
<?php       endfor; ?>
<?php       if ($pagination['current_page'] < $pagination['total_pages']): ?>
                <a class="next" href="<?= $pagination['base_url'] ?>/<?= $pagination['current_page'] + 1 ?>">Next</a>
<?php       endif; ?>
        </div>
    </div>


    
    <!-- Accept Modal HTML -->
    <div id="acceptModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Accept</h2>
            <p>Are you sure you want to accept this request?</p>
            <form id="actionForm" action="<?= base_url('admins/process_issue_request') ?>" method="post">
                <input type="hidden" name="record_id" id="record_id" value="">
                <input type="hidden" name="book_id" id="book_id" value="">
                <input type="hidden" name="student_id" id="student_id" value="">
                <button type="submit" class="btn">Yes, Accept</button>
                <button type="button" class="btn close-btn">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Decline Modal HTML -->
    <div id="declineModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Decline</h2>
            <p>Are you sure you want to decline this request?</p>
            <form id="actionFormDecline" action="<?= base_url('admins/process_decline') ?>" method="post">
                <input type="hidden" name="record_id" id="decline_record_id" value="">
                <input type="hidden" name="student_id" id="decline_student_id" value="">
                <button type="submit" class="btn">Yes, Decline</button>
                <button type="button" class="btn close-decline-btn">Cancel</button>
            </form>
        </div>
    </div>
