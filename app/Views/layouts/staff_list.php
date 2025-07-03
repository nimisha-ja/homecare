<style>
    /* General Styling for Pagination */
    .gridjs-pagination .pagination {
        display: flex;
        justify-content: flex-end;
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .gridjs-pagination .pagination li {
        margin: 0 3px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f0f0f0;
        padding: 4px 8px;
        font-size: 12px;
        line-height: 1.4;
        transition: all 0.3s ease;
    }

    .gridjs-pagination .pagination li.active {
        background-color: #405189;
        color: white !important;
        border-color: #405189;
        font-weight: bold;
    }

    .gridjs-pagination .pagination li a {
        color: #405189;
        text-decoration: none;
        font-size: 12px;
        display: block;
        padding: 4px 8px;
        text-align: center;
    }

    .gridjs-pagination .pagination li a:hover {
        background-color: #405189;
        color: white;
        border-color: #405189;
        transition: background-color 0.3s ease;
    }

    .gridjs-pagination .pagination li.disabled a {
        color: #ccc;
        pointer-events: none;
    }

    .gridjs-pagination .pagination li a:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(64, 81, 137, 0.6);
    }

    .gridjs-pagination .pagination li:hover {
        background-color: #e1e1e1;
        border-color: #ccc;
    }

    .gridjs-pagination .pagination li.active a {
        color: white !important;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Staff Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                            <li class="breadcrumb-item active">Staff Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Staff</h4>
                        <div class="col-md-12 text-end">
                            <a href="<?= base_url('/downloadStaffPdf') ?>" class="btn btn-success">
                                <i class="ri-file-pdf-line"></i> Download PDF
                            </a>
                        </div>
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
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;"> <!-- Search Bar -->
                                <div class="gridjs-head">
                                    <div class="gridjs-search">
                                        <input type="search" id="expenseSearch" placeholder="Type a keyword..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input">
                                    </div>
                                </div>
                                <div class="gridjs-wrapper" style="height: auto;">
                                    <table role="grid" id="expenseTable" class="gridjs-table" style="height: auto;text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th data-column-id="id" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 80px;">
                                                    <div class="gridjs-th-content">#</div>
                                                </th>
                                                <th data-column-id="name" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 150px;">
                                                    <div class="gridjs-th-content">Name</div>
                                                </th>
                                                <th data-column-id="nickname" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 150px;">
                                                    <div class="gridjs-th-content">Nick Name</div>
                                                </th>
                                                <th data-column-id="phone" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 220px;">
                                                    <div class="gridjs-th-content">Phone Number</div>
                                                </th>
                                                <th data-column-id="hub" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 220px;">
                                                    <div class="gridjs-th-content">Hub</div>
                                                </th>
                                                <th data-column-id="status" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 180px;">
                                                    <div class="gridjs-th-content">Status</div>
                                                </th>
                                                <th data-column-id="actions" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 150px;">
                                                    <div class="gridjs-th-content">Actions</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="expenseTableBody" class="gridjs-tbody">
                                            <?php $serialNo = $startSerial ?? 1; ?>
                                            <?php foreach ($staff as $staffMember): ?>
                                                <tr class="gridjs-tr">
                                                    <td data-column-id="id" class="gridjs-td"><?= $serialNo++; ?></td>
                                                    <td data-column-id="name" class="gridjs-td"><?= esc($staffMember['name']) ?></td>
                                                    <td data-column-id="nickname" class="gridjs-td"><?= esc($staffMember['nickname']) ?></td>
                                                    <td data-column-id="phone" class="gridjs-td"><?= esc($staffMember['phone']) ?></td>
                                                    <td data-column-id="hub" class="gridjs-td"><?= esc($staffMember['hub_name']) ?></td>
                                                    <td data-column-id="status" class="gridjs-td"><?= esc(ucwords($staffMember['status'])) ?></td>
                                                    <td data-column-id="actions" class="gridjs-td">
                                                        <span>
                                                            <a href="<?= base_url('/staff/edit/' . $staffMember['id']) ?>" class="text-reset" style="font-size: 17px;">
                                                                <i class="ri-file-edit-line"></i>
                                                            </a>
                                                            <a href="<?= base_url('/staff/view/' . $staffMember['id']) ?>" class="text-reset" style="font-size: 17px;">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            <a href="<?= base_url('/staff/delete/' . $staffMember['id']) ?>" class="text-reset" style="font-size: 17px;" onclick="return confirm('Are you sure you want to delete this staff member?');">
                                                                <i class="ri-delete-bin-6-line"></i>
                                                            </a>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="gridjs-footer">
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
</div>

<script>
    // Search function
    document.getElementById('expenseSearch').addEventListener('input', function() {
        let searchQuery = this.value.toLowerCase(); // Get the search input
        let rows = document.querySelectorAll('#expenseTableBody tr'); // Get all table rows

        rows.forEach(function(row) {
            let columns = row.querySelectorAll('td'); // Get all columns in the row
            let matched = false;

            columns.forEach(function(column) {
                if (column.textContent.toLowerCase().includes(searchQuery)) {
                    matched = true;
                }
            });

            if (matched) {
                row.style.display = ''; // Show the row if it matches the search query
            } else {
                row.style.display = 'none'; // Hide the row if it does not match the search query
            }
        });
    });
</script>