<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">CRM</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                            <li class="breadcrumb-item active">View Staff</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Back Button -->
        <div class="row">
            <div class="col-12 text-start mb-3">
                <button class="btn btn-secondary" onclick="window.history.back();">
                    <i class="ri-arrow-left-line"></i> Back
                </button>
            </div>
        </div>

        <div class="row">
            <div class="card card-primary card-outline mb-6">
                <div class="card-body text-center">

                    <!-- Staff Image Section -->
                    <?php if ($staff['image']): ?>
                        <div class="mb-4">
                            <img src="<?= base_url($staff['image']); ?>" alt="Staff Image" class="img-fluid rounded-circle" width="200" />
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            No image available.
                        </div>
                    <?php endif; ?>

                    <!-- Staff Details Table -->
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td><?= esc($staff['name']) ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?= esc($staff['phone']) ?></td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td><?= esc($staff['bankname']) ?></td>
                        </tr>
                        <tr>
                            <th>Bank Account Number</th>
                            <td><?= esc($staff['bankaccountnumber']) ?></td>
                        </tr>
                        <tr>
                            <th>IFSC</th>
                            <td><?= esc($staff['ifsccode']) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= esc($staff['status']) ?></td>
                        </tr>
                        <tr>
                            <th>Pancard</th>
                            <td>
                                <?php if ($staff['pancard']): ?>
                                    <div class="mb-4">
                                        <img src="<?= base_url($staff['pancard']); ?>" alt="pancard Image" class="img-fluid rounded-circle" width="200" />
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        No image available.
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Licence</th>
                            <td>
                                <?php if ($staff['licence']): ?>
                                    <div class="mb-4">
                                        <img src="<?= base_url($staff['licence']); ?>" alt="licence Image" class="img-fluid rounded-circle" width="200" />
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        No image available.
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Insurance</th>
                            <td>
                                <?php if ($staff['insurance']): ?>
                                    <div class="mb-4">
                                        <img src="<?= base_url($staff['insurance']); ?>" alt="insurance Image" class="img-fluid rounded-circle" width="200" />
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        No image available.
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Aadhaarcard</th>
                            <td>
                                <?php if ($staff['aadhaarcard']): ?>
                                    <div class="mb-4">
                                        <img src="<?= base_url($staff['aadhaarcard']); ?>" alt="aadhaarcard Image" class="img-fluid rounded-circle" width="200" />
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        No image available.
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>