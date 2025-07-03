<style>
    /* General Styling for Pagination */
    .gridjs-pagination .pagination {
        display: flex;
        justify-content: flex-end;
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    /* Styling for each pagination button */
    .gridjs-pagination .pagination li {
        margin: 0 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f0f0f0;
        padding: 3px 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    /* Active page styling */
    .gridjs-pagination .pagination li.active {
        background-color: #405189;
        color: white !important;
        border-color: #405189;
        font-weight: bold;
    }

    /* Regular link styling for page numbers */
    .gridjs-pagination .pagination li a {
        color: #405189;
        text-decoration: none;
        font-size: 14px;
        display: block;
        padding: 3px 6px;
        text-align: center;
    }

    /* Hover effect for links */
    .gridjs-pagination .pagination li a:hover {
        background-color: #405189;
        color: white;
        border-color: #405189;
        transition: background-color 0.3s ease;
    }

    /* Disabled page styling */
    .gridjs-pagination .pagination li.disabled a {
        color: #ccc;
        pointer-events: none;
    }

    /* Focus state for accessibility */
    .gridjs-pagination .pagination li a:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(64, 81, 137, 0.6);
    }

    /* Hover effect for pagination buttons (when not active) */
    .gridjs-pagination .pagination li:hover {
        background-color: #e1e1e1;
        border-color: #ccc;
    }

    /* Ensure text is visible in active state */
    .gridjs-pagination .pagination li.active a {
        color: white !important;
    }

    /* Table Styling */
    table th {
        background-color: #405189;
        color: white;
        font-size: 14px;
    }

    table td {
        font-size: 14px;
    }

    .card-body {
        padding: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .tfoot-row td {
        font-weight: bold;
        background-color: #f0f0f0;
    }

    .form-control,
    .form-select {
        font-size: 14px;
    }

    .alert {
        margin-bottom: 20px;
    }

    .btn-primary {
        font-size: 14px;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Announcements</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Announcements</a></li>
                            <li class="breadcrumb-item active">Announcements Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Announcements</h4>
                    </div>
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
                    <div class="card-body">
                        <div id="table-gridjs">
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-head">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Posted On</th>
                                                <?php if (!session()->has('family_id')): ?>
                                                    <th class="gridjs-th">Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $serialNo = 1; ?>
                                            <?php foreach ($announcements as $a): ?>
                                                <tr>
                                                    <td><?= esc($serialNo++) ?></td>
                                                    <td><?= esc($a['title']) ?></td>
                                                    <td><?= esc($a['content']) ?></td>
                                                    <td><?= date('d M Y', strtotime($a['created_at'])) ?></td>
                                                    <?php if (!session()->has('family_id')): ?>
                                                        <td>
                                                            <!-- Edit Link -->
                                                            <a href="<?= site_url('announcements/edit/' . $a['id']) ?>" title="Edit">
                                                                <i class="ri-file-edit-line" style="font-size: 18px;"></i>
                                                            </a>

                                                            <!-- Delete Form -->
                                                            <form action="<?= site_url('announcements/delete/' . $a['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                                                <?= csrf_field() ?>
                                                                <button type="submit" style="border: none; background: none;" title="Delete">
                                                                    <i class="ri-delete-bin-6-line" style="font-size: 18px; color: red;"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    <?php else: ?>
                                                    <?php endif; ?>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
</div>