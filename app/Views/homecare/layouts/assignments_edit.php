<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Edit Assignment</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('assignments') ?>">Assignments</a></li>
                            <li class="breadcrumb-item active">Edit Assignment</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-xxl-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Assignment Information</h4>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show ms-3" role="alert">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show ms-3" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <form method="post" action="<?= site_url('assignments/update/' . $assignment['id']) ?>">
                            <?= csrf_field() ?>
                            <div class="row g-3">

                                <!-- Client -->
                                <div class="col-md-6">
                                    <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                                    <select name="client_id" id="client_id" class="form-select" required>
                                        <?php foreach ($clients as $client): ?>
                                            <option value="<?= $client['id'] ?>" <?= $assignment['client_id'] == $client['id'] ? 'selected' : '' ?>>
                                                <?= esc($client['care_home_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Staff -->
                                <div class="col-md-6">
                                    <label for="staff_id" class="form-label">Staff <span class="text-danger">*</span></label>
                                    <select name="staff_id" id="staff_id" class="form-select" required>
                                        <?php foreach ($staff as $s): ?>
                                            <option value="<?= $s['id'] ?>" <?= $assignment['staff_id'] == $s['id'] ? 'selected' : '' ?>>
                                                <?= esc($s['full_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Shift Date -->
                                <div class="col-md-6">
                                    <label for="shift_date" class="form-label">Shift Date <span class="text-danger">*</span></label>
                                    <input type="date" name="shift_date" id="shift_date" class="form-control"
                                        value="<?= esc($assignment['shift_date']) ?>" required>
                                </div>

                                <!-- Shift Type -->
                                <div class="col-md-6">
                                    <label for="shift_type" class="form-label">Shift Type <span class="text-danger">*</span></label>
                                    <select name="shift_type" id="shift_type" class="form-select" required>
                                        <option value="day" <?= $assignment['shift_type'] == 'day' ? 'selected' : '' ?>>Day</option>
                                        <option value="night" <?= $assignment['shift_type'] == 'night' ? 'selected' : '' ?>>Night</option>
                                    </select>
                                </div>

                                <!-- Start Time -->
                                <div class="col-md-6">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control"
                                        value="<?= esc($assignment['start_time']) ?>">
                                </div>

                                <!-- End Time -->
                                <div class="col-md-6">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control"
                                        value="<?= esc($assignment['end_time']) ?>">
                                </div>

                                <!-- Submit -->
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Update Assignment</button>
                                </div>

                            </div>
                        </form>
                    </div> <!-- card-body -->

                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->

    </div> <!-- container-fluid -->
</div> <!-- page-content -->
