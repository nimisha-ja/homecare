<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Staff List</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Staff</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Staff Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="card-title">All Staff</h4>
<!-- 
                            <a href="" class="btn btn-primary">+ Add Staff</a> -->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Salary (£)</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($staffs)): ?>
                                        <?php foreach ($staffs as $index => $staff): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($staff['full_name']) ?></td>
                                                <td><?= esc($staff['email']) ?></td>
                                                <td><?= esc($staff['phone_number']) ?></td>
                                                <td><?= number_format($staff['salary'], 2) ?></td>
                                                <td><?= date('d M Y', strtotime($staff['created_at'])) ?></td>
                                                

                                                <td>
                                                    <a href="<?= site_url('staffs/edit/' . $staff['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="<?= site_url('staffs/delete/' . $staff['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this staff?');">Delete</a>
                                                </td>

                                               
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No staff found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>