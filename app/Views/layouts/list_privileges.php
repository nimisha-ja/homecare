<style>
    .gridjs-pagination .pagination {
        display: flex;
        justify-content: flex-end;
        /* Aligns pagination to the right */
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .gridjs-pagination .pagination li {
        margin: 0 3px;
        /* Reduced space between pagination items */
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f0f0f0;
        padding: 4px 8px;
        /* Reduced padding to decrease button height and width */
        font-size: 12px;
        /* Smaller font size */
        line-height: 1.4;
        /* Ensures proper vertical alignment of text */
        transition: all 0.3s ease;
        /* Smooth transition for hover and active states */
    }

    .gridjs-pagination .pagination li.active {
        background-color: #405189;
        /* Deep Blue */
        color: white !important;
        /* Ensure white text on active page */
        border-color: #405189;
        font-weight: bold;
        /* Make active page text bold */
    }

    .gridjs-pagination .pagination li a {
        color: #405189;
        /* Deep Blue */
        text-decoration: none;
        font-size: 12px;
        /* Smaller font size */
        display: block;
        /* Makes the entire button area clickable */
        padding: 4px 8px;
        /* Reduced padding for smaller buttons */
        text-align: center;
        /* Centers text inside the button */
    }

    .gridjs-pagination .pagination li a:hover {
        background-color: #405189;
        /* Deep Blue */
        color: white;
        /* Ensures text is white on hover */
        border-color: #405189;
        /* Make the border match the background on hover */
        transition: background-color 0.3s ease;
        /* Smooth hover transition */
    }

    .gridjs-pagination .pagination li.disabled a {
        color: #ccc;
        pointer-events: none;
        /* Prevents clicking on disabled pages */
    }

    .gridjs-pagination .pagination li a:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(64, 81, 137, 0.6);
        /* Subtle focus effect */
    }

    .gridjs-pagination .pagination li:hover {
        background-color: #e1e1e1;
        /* Light gray hover effect for non-active pages */
        border-color: #ccc;
        /* Lighter border on hover */
    }

    .gridjs-pagination .pagination li.active a {
        color: white !important;
        /* Make sure active text is always white */
    }

    /* Additional Styling for Search Bar */
    .search-bar {
        margin-bottom: 20px;
        text-align: center;
    }

    #expenseSearch {
        width: 300px;
        padding: 8px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-top: 10px;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Privileges Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Privileges</a></li>
                            <li class="breadcrumb-item active">Privileges Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="addprivilages" class="btn btn-secondary">Change Privileges</a>
                    </div> <!-- Flash Message Section -->
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
                        <div class="gridjs-wrapper" style="height: auto;">
                            <table role="grid" class="gridjs-table" style="height: auto; text-align: center; width: 100%; border-collapse: collapse;">
                                <thead class="gridjs-thead">
                                    <tr class="gridjs-tr">
                                        <th class="gridjs-th gridjs-th-sort" style="width: 80px; border: 1px solid #ddd;">#</th>
                                        <th class="gridjs-th gridjs-th-sort" style="width: 150px; border: 1px solid #ddd;">Role</th>
                                        <th class="gridjs-th gridjs-th-sort" style="width: 150px; border: 1px solid #ddd;">Menu</th>
                                    </tr>
                                </thead>
                                <tbody class="gridjs-tbody" id="expenseTableBody">
                                    <?php
                                    $groupedPrivileges = [];
                                    foreach ($privileges as $privilege) {
                                        $groupedPrivileges[$privilege['role_name']][] = $privilege['menu_name'];
                                    }
                                    ?>
                                    <?php $roleNamesDisplayed = 0; ?>
                                    <?php foreach ($groupedPrivileges as $roleName => $menuNames): ?>
                                        <tr class="gridjs-tr">
                                            <td class="gridjs-td"><?= ++$roleNamesDisplayed; ?></td>
                                            <td class="gridjs-td"><?= esc($roleName); ?></td>
                                            <td class="gridjs-td"><?= implode('<br>', array_map('esc', $menuNames)); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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