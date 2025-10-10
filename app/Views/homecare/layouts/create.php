<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Client</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('clients') ?>">Clients</a></li>
                            <li class="breadcrumb-item active">Add Client</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-xxl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Client Information</h4>
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
                        <form action="<?= site_url('clients/store') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="row">

                                <!-- Basic Info -->
                                <div class="col-md-6 mb-3">
                                    <label for="care_home_name" class="form-label">Care Home Name</label>
                                    <input type="text" name="care_home_name" class="form-control" id="care_home_name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="provider_name" class="form-label">Provider Name</label>
                                    <input type="text" name="provider_name" class="form-control" id="provider_name">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="post_code" class="form-label">Post Code</label>
                                    <input type="text" name="post_code" class="form-control" id="post_code">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="manager_name" class="form-label">Manager Name</label>
                                    <input type="text" name="manager_name" class="form-control" id="manager_name">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Main Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="accounts_email" class="form-label">Accounts Email</label>
                                    <input type="email" name="accounts_email" class="form-control" id="accounts_email">
                                </div>

                                <!-- Normal Rates - HCA -->
                                <div class="col-md-12 mt-4"><h5>Normal Rates – HCA</h5></div>

                                <div class="col-md-4 mb-3">
                                    <label>Weekdays Day</label>
                                    <input type="number" step="0.01" name="hca_weekday_day" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Weekdays Night</label>
                                    <input type="number" step="0.01" name="hca_weekday_night" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Weekends Day</label>
                                    <input type="number" step="0.01" name="hca_weekend_day" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Weekends Night</label>
                                    <input type="number" step="0.01" name="hca_weekend_night" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Bank Holidays</label>
                                    <input type="number" step="0.01" name="hca_bank_holiday" class="form-control">
                                </div>

                                <!-- Normal Rates - Nurses -->
                                <div class="col-md-12 mt-4"><h5>Normal Rates – Nurses</h5></div>

                                <div class="col-md-4 mb-3">
                                    <label>Weekdays Day</label>
                                    <input type="number" step="0.01" name="nurse_weekday_day" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Weekdays Night</label>
                                    <input type="number" step="0.01" name="nurse_weekday_night" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Weekends Day</label>
                                    <input type="number" step="0.01" name="nurse_weekend_day" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Weekends Night</label>
                                    <input type="number" step="0.01" name="nurse_weekend_night" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Bank Holidays</label>
                                    <input type="number" step="0.01" name="nurse_bank_holiday" class="form-control">
                                </div>

                                <!-- Special Rates -->
                                <div class="col-md-12 mt-4"><h5>Special Rates</h5></div>

                                <div class="col-md-6 mb-3">
                                    <label>Below 8 Hours</label>
                                    <input type="number" step="0.01" name="special_rate_below_8hrs" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Above 8 Hours</label>
                                    <input type="number" step="0.01" name="special_rate_above_8hrs" class="form-control">
                                </div>

                                <!-- File Upload -->
                                <div class="col-md-12 mb-3">
                                    <label for="contract_file" class="form-label">Upload Contract</label>
                                    <input type="file" name="contract_file" class="form-control" accept=".pdf,.doc,.docx">
                                </div>

                                <!-- Submit -->
                                <div class="col-12 mt-4">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save Client</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
