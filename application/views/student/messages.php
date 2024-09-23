    <div class="messages">
<?php   if (!empty($messages)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Messages</th>
                        <th>Date and time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($messages as $message): ?>
                        <tr>
                            <td><?= htmlspecialchars($message['content'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<?php   else: ?>
            <p class="no_found">No messages.</p>
<?php   endif; ?>

        <!-- Debugging Pagination Data -->
        <!-- <p>Current Page: <?= $pagination['current_page'] ?></p>
        <p>Total Pages: <?= $pagination['total_pages'] ?></p>
        <p>Base URL: <?= $pagination['base_url'] ?></p> -->


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
