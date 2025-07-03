<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Edit Family Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Family Management</a></li>
                            <li class="breadcrumb-item active">Edit Family</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Family Details</h4>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        <div class="live-preview">
                            <h3>Edit Announcement</h3>

                            <form method="post" action="<?= site_url('announcements/update/' . $announcement['id']) ?>">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="<?= esc($announcement['title']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Content</label>
                                    <textarea name="content" class="form-control" rows="5" required><?= esc($announcement['content']) ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>