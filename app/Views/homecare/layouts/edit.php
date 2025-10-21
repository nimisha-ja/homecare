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
            <div class="col-xxl-12">
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

                            <div class="row">
                                <!-- Basic Info -->
                                <div class="col-md-6 mb-3">
                                    <label for="care_home_name" class="form-label">Care Home Name</label>
                                    <input type="text" id="care_home_name" name="care_home_name" class="form-control" value="<?= esc($client['care_home_name']) ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="provider_name" class="form-label">Provider Name</label>
                                    <input type="text" id="provider_name" name="provider_name" class="form-control" value="<?= esc($client['provider_name']) ?>">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea id="address" name="address" class="form-control" rows="2"><?= esc($client['address']) ?></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="post_code" class="form-label">Post Code</label>
                                    <input type="text" id="post_code" name="post_code" class="form-control" value="<?= esc($client['post_code']) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="manager_name" class="form-label">Manager Name</label>
                                    <input type="text" id="manager_name" name="manager_name" class="form-control" value="<?= esc($client['manager_name']) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?= esc($client['phone_number']) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?= esc($client['email']) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="accounts_email" class="form-label">Accounts Email</label>
                                    <input type="email" id="accounts_email" name="accounts_email" class="form-control" value="<?= esc($client['accounts_email']) ?>">
                                </div>

                                <!-- Normal Rates – HCA -->
                                <div class="col-md-12 mt-4">
                                    <h5>Normal Rates – HCA</h5>
                                </div>
                                <?php
                                $hcaFields = ['hca_weekday_day', 'hca_weekday_night', 'hca_weekend_day', 'hca_weekend_night', 'hca_bank_holiday'];
                                foreach ($hcaFields as $field): ?>
                                    <div class="col-md-4 mb-3">
                                        <label><?= ucwords(str_replace('_', ' ', $field)) ?></label>
                                        <input type="number" step="0.01" name="<?= $field ?>" class="form-control" value="<?= esc($client[$field]) ?>">
                                    </div>
                                <?php endforeach; ?>

                                <!-- Normal Rates – Nurses -->
                                <div class="col-md-12 mt-4">
                                    <h5>Normal Rates – Nurses</h5>
                                </div>
                                <?php
                                $nurseFields = ['nurse_weekday_day', 'nurse_weekday_night', 'nurse_weekend_day', 'nurse_weekend_night', 'nurse_bank_holiday'];
                                foreach ($nurseFields as $field): ?>
                                    <div class="col-md-4 mb-3">
                                        <label><?= ucwords(str_replace('_', ' ', $field)) ?></label>
                                        <input type="number" step="0.01" name="<?= $field ?>" class="form-control" value="<?= esc($client[$field]) ?>">
                                    </div>
                                <?php endforeach; ?>

                                <!-- Special Rates -->
                                <div class="col-md-12 mt-4">
                                    <h5>Special Rates</h5>
                                </div>
                                <?php
                                $specialFields = [
                                    'special_weekday_day',
                                    'special_weekday_night',
                                    'special_weekend_day',
                                    'special_weekend_night',
                                    'special_bank_holiday',
                                    'special_early_shift',
                                    'special_late_shift',
                                    'special_rate_below_8hrs',
                                    'special_rate_above_8hrs'
                                ];
                                foreach ($specialFields as $field): ?>
                                    <div class="col-md-4 mb-3">
                                        <label><?= ucwords(str_replace('_', ' ', $field)) ?></label>
                                        <input type="number" step="0.01" name="<?= $field ?>" class="form-control" value="<?= esc($client[$field]) ?>">
                                    </div>
                                <?php endforeach; ?>

                                <!-- Upload New Contract -->
                                <div class="col-md-12 mb-3">
                                    <label for="contract_file" class="form-label">Upload New Contract (optional)</label>
                                    <input type="file" id="contract_file" name="contract_file" class="form-control" accept=".pdf,.doc,.docx">
                                </div>

                                <!-- Submit -->
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-primary">Update Client</button>
                                </div>
                            </div>
                        </form>


                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->

    </div> <!-- container-fluid -->
</div> <!-- page-content -->