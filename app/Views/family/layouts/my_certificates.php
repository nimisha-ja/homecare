<style>
    /* General Styling for Pagination */
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

    .gridjs-pagination .pagination li a:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(64, 81, 137, 0.3);
    }

    .gridjs-pagination .pagination li:hover:not(.active):not(.disabled) {
        background-color: #e2e6ea;
        border-color: #ccc;
    }
</style>
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">certificates</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">certificates</a></li>
                            <li class="breadcrumb-item active">certificates Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Certificates</h4>
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
                                </div>
                                <div class="gridjs-wrapper" style="height: auto;">
                                    <?php if (!empty($certificates)): ?>
                                        <table class="table table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Famiy Code</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                foreach ($certificates as $cert): ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= esc($cert['family_code']) ?></td>
                                                        <td><?= esc($cert['certificate_type']) ?></td>
                                                        <td><?= esc($cert['status']) ?></td>
                                                        <td>
                                                            <?php if (!empty($cert['certificate_file'])): ?>
                                                                <a href="<?= base_url('uploads/certificates/' . $cert['certificate_file']) ?>" target="_blank" class="btn btn-sm btn-success">Download</a>
                                                            <?php else: ?>
                                                                Not uploaded
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <div class="alert alert-info">No certificates/requests yet.</div>
                                    <?php endif; ?>

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