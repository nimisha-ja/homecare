<style>
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
                    <h4 class="mb-sm-0">Clients</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">HomeCare</a></li>
                            <li class="breadcrumb-item active">Client List</li>
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

        <!-- Client Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-2">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Client List</h4>
                    </div>
                    <div class="card-body">
                        <div id="table-gridjs">
                            <div class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-wrapper" style="height: auto;">
                                    <table class="gridjs-table table table-bordered text-center">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th">#</th>
                                                <th class="gridjs-th">Care Home</th>
                                                <th class="gridjs-th">Provider</th>
                                                <th class="gridjs-th">Manager</th>
                                                <th class="gridjs-th">Phone</th>
                                                <th class="gridjs-th">Email</th>
                                                <th class="gridjs-th">Post Code</th>
                                                <th class="gridjs-th">Contract</th>
                                                <th class="gridjs-th">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $i = 1; ?>
                                            <?php if (!empty($clients)): ?>
                                                <?php foreach ($clients as $client): ?>
                                                    <tr class="gridjs-tr align-middle">
                                                        <td class="gridjs-td"><?= $i++ ?></td>
                                                        <td class="gridjs-td"><?= esc($client['care_home_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($client['provider_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($client['manager_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($client['phone_number']) ?></td>
                                                        <td class="gridjs-td"><?= esc($client['email']) ?></td>
                                                        <td class="gridjs-td"><?= esc($client['post_code']) ?></td>
                                                        <td class="gridjs-td">
                                                            <?php if (!empty($client['contract_file'])): ?>
                                                                <a href="<?= base_url('uploads/contracts/' . $client['contract_file']) ?>" target="_blank" class="btn btn-sm btn-info">View</a>
                                                            <?php else: ?>
                                                                <span class="text-muted">No file</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="gridjs-td">
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <a href="<?= site_url('clients/edit/' . $client['id']) ?>" title="Edit">
                                                                    <i class="ri-edit-2-line text-primary" style="font-size: 18px;"></i>
                                                                </a>
                                                                <form action="<?= site_url('clients/delete/' . $client['id']) ?>" method="post" onsubmit="return confirm('Delete this client?');">
                                                                    <?= csrf_field() ?>
                                                                    <button type="submit" title="Delete" style="background: none; border: none;">
                                                                        <i class="ri-delete-bin-6-line text-danger" style="font-size: 18px;"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="gridjs-tr">
                                                    <td class="gridjs-td" colspan="9">No clients found.</td>
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
