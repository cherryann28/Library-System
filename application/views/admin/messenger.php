      

    <div class="forms-container">
<?php
    $this->load->view('partials/flash_messages');
?>
        <div class="form-container">
            <h3 class="mb-4">Send Message</h3>
            
            <form action="<?= base_url('admins/process_message') ?>" method="POST">
                <div class="form-group">
                    <label for="school_id" class="form-label">Receiver Student ID</label>
                    <span><?=$this->session->flashdata('school_id') ?></span>
                    <input type="text" class="form-control" id="school_id" name="school_id" placeholder="Enter receiver student ID">
                </div>
                <div class="form-group mt-2">
                    <label for="content" class="form-label">Message</label>
                    <span><?=$this->session->flashdata('content') ?></span>
                    <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" class="btn btn-message">Send Message</button>
            </form>
        </div>
    </div 
