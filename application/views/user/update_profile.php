

<div class="forms-container">
    <?php $this->load->view('partials/flash_messages'); ?>
        <div class="form-container">
            <h3 class="mb-4">Update Details</h3>
            
            <form action="<?= base_url('users/process_update_user');?>/<?= $user['id'] ?>" method="POST">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div class="row mb-2"> <!-- Changed form-row to row -->
                    <div class="col-md-6"> <!-- Using Bootstrap column classes -->
                        <div class="form-group">
                            <label for="school_id" class="form-label">School Id</label>
                            <span><?=$this->session->flashdata('school_id') ?></span>
                            <input type="text" class="form-control" id="school_id" name="school_id" value="<?= $user['school_id'] ?>" placeholder="Enter school id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <span><?=$this->session->flashdata('name') ?></span> 
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" placeholder="Enter name">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_number" class="form-label">Contact number</label>
                            <span><?=$this->session->flashdata('contact_number') ?></span>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= $user['contact_number'] ?>" placeholder="Enter contact number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <span><?=$this->session->flashdata('email') ?></span>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <span><?=$this->session->flashdata('password') ?></span>
                            <input type="password" class="form-control" id="password" name="password" value="<?= $user['password'] ?>" placeholder="Enter password">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-update">Update</button>
            </form>
        </div>
    </div>
