

    <div class="forms-container">
<?php 
    $this->load->view('partials/flash_messages'); 
?>
        <div class="form-container">
            <h3 class="mb-4">Update Details</h3>
            
            <form action="<?= base_url('admins/process_update');?>/<?= $book['id'] ?>" method="POST">
                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                <div class="row mb-2"> 
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="accesion" class="form-label">Accession</label>
                            <span><?=$this->session->flashdata('accesion') ?></span>
                            <input type="text" class="form-control" id="accesion" name="accesion" value="<?= $book['accesion'] ?>" placeholder="Enter accession number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <span><?=$this->session->flashdata('title') ?></span>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $book['title'] ?>" placeholder="Enter book title">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publisher" class="form-label">Publisher</label>
                            <span><?=$this->session->flashdata('publisher') ?></span>
                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?= $book['publisher'] ?>" placeholder="Enter publisher's name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="year" class="form-label">Year</label>
                            <span><?=$this->session->flashdata('year') ?></span>
                            <input type="text" class="form-control" id="year" name="year" value="<?= $book['year'] ?>" placeholder="Enter year">
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="availability" class="form-label">Availability</label>
                            <span><?=$this->session->flashdata('availability') ?></span>
                            <input type="text" class="form-control" id="availability" name="availability" value="<?= $book['availability'] ?>" placeholder="Enter availability">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-update">Update</button>
            </form>
        </div>
    </div>
