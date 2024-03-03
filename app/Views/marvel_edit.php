<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
 <!-- View edit character -->
<h3 class="my-3">New character</h3>
<!-- Message validation if error response edit -->
<?php if (session()->getFlashdata('error') !== null) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php } ?> 

<form action="<?= base_url('marvel/' . $character['id']); ?>" class="row g-3" method="post">
    <input type="hidden" name="_method" value="put"> 
    <div class="col-md-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $character['name'] ?>" required>
    </div>  
    <?php if (!empty($character['thumbnail'])) : ?>
        <div class="col-md-12">
        <label class="form-label">Preview</label>
        <div class="d-flex flex-column align-items-center">
        <!--Validation image if url valid or image jpg-->
        <?php 
            if (filter_var($character['thumbnail'], FILTER_VALIDATE_URL)) { 
                echo '<img src="' . $character['thumbnail'] . '" class="img-thumbnail img-content mb-2">';
            } else { 
                $imageUrl = base_url('public/charactersImg/' . $character['thumbnail']); 
                echo '<img src="' . $imageUrl . '" class="img-thumbnail img-content mb-2">';
            }
        ?> 
        </div>
    </div>
    <?php endif; ?>  
    <div class="col-md-12">
     <label for="image" class="form-label">Image</label>
     <input type="text" disabled class="form-control" id="image" name="image" value="<?=  $character['thumbnail']  ?>" >
    </div> 
    <div class="col-md-12">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description"><?= $character['description'] ?></textarea>
    </div> 
    <div class="col-12 mt-3">
        <a href="<?= base_url('/'); ?>" class="btn btn-dark">Back</a>
        <button type="submit" class="btn btn-warning">Save</button>
    </div>
</form>

<?= $this->endSection() ?>