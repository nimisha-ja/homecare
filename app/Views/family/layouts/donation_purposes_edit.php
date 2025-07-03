<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Family Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> Add Family Details</a></li>
                            <li class="breadcrumb-item active">Add Family Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add Family Details</h4>
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">

                            <div class="card-body">
                                <div class="live-preview">
                                    <div class="row">
                                        <h2>Edit Donation Purpose</h2>
                                        <form method="post" action="<?= site_url('donationpurposes/update/' . $purpose['id']) ?>">
                                            <?= csrf_field() ?>
                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title:</label>
                                                    <input type="text" id="title" name="title" class="form-control" value="<?= esc($purpose['title']) ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description:</label>
                                                    <textarea id="description" name="description" class="form-control" rows="3"><?= esc($purpose['description']) ?></textarea>
                                                </div>

                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" <?= $purpose['is_active'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="is_active">Active</label>
                                                </div>

                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>

                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>