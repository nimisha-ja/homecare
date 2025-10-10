<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Edit Client Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Client Management</a></li>
                            <li class="breadcrumb-item active">Edit Client</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Client Details</h4>
                    </div>
                    <div class="card-body">

                        <!-- Flash Messages -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <!-- Edit Client Form -->
                        <form action="<?= site_url('clients/update/' . $client['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="care_home_name" class="form-label">Care Home Name</label>
                                <input type="text" id="care_home_name" name="care_home_name" class="form-control" value="<?= esc($client['care_home_name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="provider_name" class="form-label">Provider Name</label>
                                <input type="text" id="provider_name" name="provider_name" class="form-control" value="<?= esc($client['provider_name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="manager_name" class="form-label">Manager Name</label>
                                <input type="text" id="manager_name" name="manager_name" class="form-control" value="<?= esc($client['manager_name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?= esc($client['phone_number']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= esc($client['email']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="post_code" class="form-label">Post Code</label>
                                <input type="text" id="post_code" name="post_code" class="form-control" value="<?= esc($client['post_code']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="accounts_email" class="form-label">Accounts Email</label>
                                <input type="email" id="accounts_email" name="accounts_email" class="form-control" value="<?= esc($client['accounts_email']) ?>">
                            </div>

                            <div class="mb-3">
                                <label for="contract_file" class="form-label">Upload New Contract (optional)</label>
                                <input type="file" id="contract_file" name="contract_file" class="form-control">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Client</button>
                            </div>
                        </form>

                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->

    </div> <!-- container-fluid -->
</div> <!-- page-content -->
