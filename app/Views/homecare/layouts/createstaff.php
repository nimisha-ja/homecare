<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Staff</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('staffs') ?>">Staffs</a></li>
                            <li class="breadcrumb-item active">Add Staff</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-xxl-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Staff Information</h4>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('staffs/store') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" value="<?= old('full_name') ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value="<?= old('phone_number') ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Salary</label>
                                    <input type="number" step="0.01" name="salary" class="form-control" value="<?= old('salary') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Visa Type</label>
                                    <input type="text" name="visa_type" class="form-control" value="<?= old('visa_type') ?>" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Current Address</label>
                                    <textarea name="current_address" class="form-control" rows="2" required><?= old('current_address') ?></textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Permanent Address</label>
                                    <textarea name="permanent_address" class="form-control" rows="2" required><?= old('permanent_address') ?></textarea>
                                </div>

                                <!-- File Uploads -->
                                <?php
                                $fileFields = [
                                    'passport_file' => 'Passport File',
                                    'dbs_file' => 'DBS File',
                                    'brp_file' => 'BRP File',
                                    'application_form_file' => 'Application Form',
                                    'checklist_file' => 'Checklist',
                                    'training_certificate_file' => 'Training Certificate',
                                    'reference_1_file' => 'Reference 1',
                                    'reference_2_file' => 'Reference 2',
                                    'passport_photo_file' => 'Passport Photo',
                                    'bank_statement_file' => 'Bank Statement',
                                ];
                                ?>

                                <?php foreach ($fileFields as $name => $label): ?>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><?= $label ?></label>
                                        <input type="file" name="<?= $name ?>" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    </div>
                                <?php endforeach; ?>

                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-primary">Save Staff</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>