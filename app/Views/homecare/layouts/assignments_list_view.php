>

<style>
    /* Your custom pagination styles */
    .gridjs-pagination .pagination {
        display: flex;
        justify-content: flex-end;
        list-style: none;
        padding: 0;
        margin: 1rem 0;
        flex-wrap: wrap;
        gap: 6px;
    }

    .gridjs-pagination .pagination li {
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #f8f9fa;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .gridjs-pagination .pagination li a {
        display: block;
        padding: 6px 12px;
        color: #405189;
        text-decoration: none;
        font-weight: 500;
        border-radius: 6px;
    }

    .gridjs-pagination .pagination li a:hover {
        background-color: #405189;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .gridjs-pagination .pagination li.active,
    .gridjs-pagination .pagination li.active a {
        background-color: #405189;
        color: white !important;
        border-color: #405189;
        font-weight: 600;
    }

    .gridjs-pagination .pagination li.disabled a {
        color: #ccc;
        pointer-events: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>

<div class="page-content">
    <div class="container-fluid">

        <!-- Title and Breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Assignments</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>">HomeCare</a></li>
                            <li class="breadcrumb-item active">Assignments List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Search Filters -->
        <form method="get" action="<?= site_url('getassignments') ?>" class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="date" class="form-label">Shift Date</label>
                <input type="date" name="date" id="date" value="<?= esc($date ?? '') ?>" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="client_id" class="form-label">Client</label>
                <select name="client_id" id="client_id" class="form-select">
                    <option value="">-- Select Client --</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?= $client['id'] ?>" <?= (isset($client_id) && $client_id == $client['id']) ? 'selected' : '' ?>>
                            <?= esc($client['care_home_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="shift_type" class="form-label">Shift Type</label>
                <select name="shift_type" id="shift_type" class="form-select">
                    <option value="">-- Select Shift --</option>
                    <option value="day" <?= (isset($shift_type) && $shift_type == 'day') ? 'selected' : '' ?>>Day</option>
                    <option value="night" <?= (isset($shift_type) && $shift_type == 'night') ? 'selected' : '' ?>>Night</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="staff_id" class="form-label">Staff Name</label>
                <select name="staff_id" id="staff_id" class="form-select">
                    <option value="">-- Select Staff --</option>
                    <?php if (!empty($staff)): ?>
                        <?php foreach ($staff as $s): ?>
                            <option value="<?= esc($s['id']) ?>" <?= (isset($staff_id) && $staff_id == $s['id']) ? 'selected' : '' ?>>
                                <?= esc($s['full_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled>No staff available</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>


        <!-- Assignments Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Assignments List</h4>
                    </div>
                    <div class="card-body p-0">
                        <div id="table-gridjs">
                            <table class="table table-bordered text-center mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Staff</th>
                                        <th>Shift Date</th>
                                        <th>Shift Type</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($assignments)) : ?>
                                        <?php foreach ($assignments as $assignment) : ?>
                                            <tr>
                                                <td><?= esc($assignment['client_name']) ?></td>
                                                <td><?= esc($assignment['staff_name']) ?></td>
                                                <td><?= esc($assignment['shift_date']) ?></td>
                                                <td><?= ucfirst(esc($assignment['shift_type'])) ?></td>
                                                <td><?= esc($assignment['start_time']) ?></td>
                                                <td><?= esc($assignment['end_time']) ?></td>
                                                <td>
                                                    <a href="<?= site_url('assignments/edit/' . $assignment['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="<?= site_url('assignments/delete/' . $assignment['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure want to delete this assignment?');">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">No assignments found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="gridjs-pagination px-3 pb-3">
                            <!-- <//?= $pager->links() ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>