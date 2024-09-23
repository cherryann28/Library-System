<?php 
    $current_page = isset($current_page) ? $current_page : 1;
    $number_of_pages = isset($number_of_pages) ? $number_of_pages : 1;
?>

        <div class="data">
            <div class="search">
                <form action="<?= base_url()?>admins/process_search_student" method="post">
                    <input type="text" placeholder="Search Student ID/Name" name="search">
                </form>
            </div>
<?php       if (!empty($students)): ?>
            <h2>Student List</h2>
            <table>
                <thead>
                    <tr>
                       <th>Name</th>
                       <th>Student ID</th>
                       <th>Email Address</th>
                       <th>Category</th>
                       <th>Mobile No.</th>
                    </tr>
                </thead>
                <tbody>
<?php               foreach ($students as $student): ?>
                        <tr>
                            <td><?= ucfirst($student['name'])?></td>
                            <td><?= ucfirst($student['school_id'])?></td>
                            <td><?= $student['email']?></td>
                            <td><?= ucfirst($student['user_level'])?></td>
                            <td><?= $student['contact_number']?></td>
                        </tr>
<?php               endforeach; ?>
                </tbody>
            </table>   
<?php   else: ?>
            <p class="no_found">No students found.</p>
<?php   endif; ?>  




        <!-- Pagination -->
            <div class="pagination">
<?php           if ($current_page > 1): ?>
                    <a class="previous" href="<?= base_url('student_list?page=' . ($current_page - 1)) ?>">Previous</a>
<?php           endif; ?>

<?php           for ($page = 1; $page <= $number_of_pages; $page++): ?>
<?php               if ($page == $current_page): ?>
                        <strong><?= $page ?></strong>
<?php               else: ?>
                        <a href="<?= base_url('student_list?page=' . $page) ?>"><?= $page ?></a>
<?php               endif; ?>
<?php           endfor; ?>

<?php           if ($current_page < $number_of_pages): ?>
                    <a class="next" href="<?= base_url('student_list?page=' . ($current_page + 1)) ?>">Next</a>
<?php           endif; ?>
            </div>    
        </div>