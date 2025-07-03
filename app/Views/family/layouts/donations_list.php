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
                    <h4 class="mb-sm-0">Donations</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Donations</a></li>
                            <li class="breadcrumb-item active">Donations List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Donation </h4>
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
                                    <!-- <div class="gridjs-search">
                                        <input type="search" id="search-bar" placeholder="Search users..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input">
                                    </div> -->
                                </div>
                                <div class="gridjs-wrapper" style="height: auto;">

                                    <table class="gridjs-table" style="width: 100%; text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th">#</th>
                                                <th class="gridjs-th">Family</th>
                                                <th class="gridjs-th">Purpose</th>
                                                <th class="gridjs-th">Amount</th>
                                                <th class="gridjs-th">Date</th>
                                                <th class="gridjs-th">Notes</th>
                                                <?php if (!session()->has('family_id')): ?>
                                                    <th class="gridjs-th">Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $i = 1; ?>
                                            <?php if (!empty($donations)): ?>
                                                <?php foreach ($donations as $donation): ?>
                                                    <tr class="gridjs-tr">
                                                        <td class="gridjs-td"><?= $i++ ?></td>
                                                        <td class="gridjs-td"><?= esc($donation['family_name']) ?></td>
                                                        <td class="gridjs-td"><?= esc($donation['purpose_title']) ?></td>
                                                        <td class="gridjs-td">₹<?= number_format($donation['amount'], 2) ?></td>
                                                        <td class="gridjs-td"><?= esc($donation['donation_date']) ?></td>
                                                        <td class="gridjs-td"><?= esc($donation['notes']) ?></td>
                                                        <?php if (!session()->has('family_id')): ?>
                                                            <td class="gridjs-td">
                                                                <div class="d-flex justify-content-center gap-2">
                                                                    <!-- Edit Link -->
                                                                    <a href="<?= site_url('donations/edit/' . $donation['id']) ?>" title="Edit">
                                                                        <i class="ri-edit-2-line" style="font-size: 18px;"></i>
                                                                    </a>

                                                                    <!-- Delete Form -->
                                                                    <form action="<?= site_url('donations/delete/' . $donation['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this donation?')">
                                                                        <?= csrf_field() ?>
                                                                        <button type="submit" style="border: none; background: none;" title="Delete">
                                                                            <i class="ri-delete-bin-line" style="font-size: 18px; color: red;"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        <?php else: ?>

                                                        <?php endif; ?>

                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="gridjs-tr">
                                                    <td colspan="6" class="gridjs-td">No donations found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
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