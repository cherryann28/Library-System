

    <div class="card-container mt-5">
    <?php $this->load->view('partials/flash_messages'); ?>
        <div class="card">
            <div class="card-header">
                <h5>User Profile</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><strong>Name:</strong> <?= ucfirst($users['name']) ?></p>
                <p class="card-text"><strong>Email:</strong> <?= $users['email'] ?></p>
                <p class="card-text"><strong>Contact Number: </strong> <?= $users['contact_number'] ?></p>
                <a href="<?= base_url('users/edit_user');?>/<?= $users['id']?>" class="btn btn-edit">Edit Profile</a>
            </div>
        </div>
    </div>
