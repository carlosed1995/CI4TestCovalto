<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<!-- View create character -->
<h3 class="my-3">New character</h3>
<!-- Message validation if error response create -->
<?php if (session()->getFlashdata('error') !== null) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php } ?>

<form action="<?= base_url('marvel'); ?>" class="row g-3" method="post" enctype="multipart/form-data">
    <div class="col-md-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
    </div>
    <div class="col-md-12">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="file" class="form-control" id="file" required> 
    </div>
    <div class="col-md-12">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description"><?= old('description') ?></textarea>
    </div>
    <div class="col-12 mt-3">
        <a href="<?= base_url('/'); ?>" class="btn btn-dark">Back</a>
        <button type="submit" class="btn btn-warning">Save</button>
    </div>
</form>

<?= $this->endSection() ?>