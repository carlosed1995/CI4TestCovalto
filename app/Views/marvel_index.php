<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
        <!-- View index character -->
        <!-- Message validation if success response create or edit data -->
        <?php if (session()->getFlashdata('success') !== null) { ?>
            <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
            </div>
        <?php } ?>
        <div class="my-3">
            <a class="btn btn-dark" href="<?= base_url('marvel/new'); ?>" role="button">Create Character</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($characters)): ?>
                    <?php foreach ($characters as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td> 
                            <td>
                            <!--Validation image if url valid or image jpg-->
                            <?php 
                                if (filter_var($row['thumbnail'], FILTER_VALIDATE_URL)) { 
                                    echo '<img src="' . $row['thumbnail'] . '" class="img-thumbnail img-content">';
                                } else { 
                                    $imageUrl = base_url('public/charactersImg/' . $row['thumbnail']); 
                                    echo '<img src="' . $imageUrl . '" class="img-thumbnail img-content">';
                                }
                                ?>
                            </td>
                            <td>
                             <div class="d-grid gap-2 col-6">
                                <a class="btn btn-primary" href="<?= base_url('marvel/' . $row['id'] . '/edit'); ?>" role="button">Edit</a> 
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-url="<?= base_url('marvel/' . $row['id']); ?>">Delete</button>
                             </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            <div class="alert alert-danger" role="alert">
                                <strong>No Data</strong>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table> 
        <?= $pager->links('default', 'pagination'); ?>
        <!-- Load modal delete character -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Warning</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-item" action="" method="post">
                        <input type="hidden" name="_method" value="delete">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Custom JavaScript: This file contains logic for the delete modal -->
    <script src="<?= base_url('public/js/custom.js') ?>"></script>

<?= $this->endSection() ?>