assignments_list.php<style>
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
                            <li class="breadcrumb-item"><a href="#">HomeCare</a></li>
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

        <!-- Assignments Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Assignments List</h4>
                    </div>
                    <div class="card-body">
                        <div id="table-gridjs">
                            <div class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-wrapper" style="height: auto;">
                                    <table class="gridjs-table table table-bordered text-center">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th">Client</th>
                                                <th class="gridjs-th">Staff</th>
                                                <th class="gridjs-th">Shift Date</th>
                                                <th class="gridjs-th">Shift Type</th>
                                                <th class="gridjs-th">Start Time</th>
                                                <th class="gridjs-th">End Time</th>
                                                <th class="gridjs-th">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php if (!empty($assignments)) : ?>
                                                <?php foreach ($assignments as $assignment) : ?>
                                                    <tr class="gridjs-tr align-middle">
                                                        <td class="gridjs-td"><?= esc($assignment['care_home_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($assignment['full_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($assignment['shift_date']) ?></td>
                                                        <td class="gridjs-td"><?= esc(ucfirst($assignment['shift_type'])) ?></td>
                                                        <td class="gridjs-td"><?= esc($assignment['start_time']) ?></td>
                                                        <td class="gridjs-td"><?= esc($assignment['end_time']) ?></td>
                                                        </td>
                                                        <td>
                                                            <a href="<?= site_url('assignments/edit/' . $assignment['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                                            <form action="<?= site_url('assignments/delete/' . $assignment['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                                                <?= csrf_field() ?>
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        </td></tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr class="gridjs-tr">
                                                        <td class="gridjs-td" colspan="6">No assignments found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="gridjs-pagination">
                                <?= $pager->links() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>