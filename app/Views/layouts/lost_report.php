<style>
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
                    <h4 class="mb-sm-0">Consolidated Lost Statement</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Deliveries</a></li>
                            <li class="breadcrumb-item active">Loss Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Consolidated Lost Statement</h4>
                        <div class="col-md-12 text-end"><!-- Download PDF Button -->
                            <a href="<?= base_url('/lostreport/download_pdf?' . http_build_query([
                                            'start_date' => $start_date ?? '',
                                            'end_date'   => $end_date ?? '',
                                            'hub_id'     => $selectedHubId ?? ''
                                        ])) ?>" class="btn btn-success">
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
                        <form action="" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?= esc($start_date) ? esc($start_date) : date('Y-m-01') ?>" required>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="<?= esc($end_date) ? esc($end_date) : date('Y-m-d') ?>" required>
                                </div>
                                <?php if ($userRole == 1): ?>
                                    <div class="col-md-3">
                                        <label for="hub_id" class="form-label">Select Hub</label>
                                        <select name="hub_id" id="hub_id" class="form-select">
                                            <option value="">All Hubs</option>
                                            <?php foreach ($hubs as $hub): ?>
                                                <option value="<?= esc($hub['hub_id']) ?>"
                                                    <?= isset($selectedHubId) && $selectedHubId == $hub['hub_id'] ? 'selected' : '' ?>>
                                                    <?= esc($hub['hub_name']) ?>
                                                </option><?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="gridjs-wrapper" style="height: auto;">
                            <table role="grid" class="gridjs-table" style="height: auto; text-align: center;">
                                <thead class="gridjs-thead">
                                    <tr class="gridjs-tr">
                                        <th class="gridjs-th">#</th>
                                        <th class="gridjs-th">Staff ID</th>
                                        <th class="gridjs-th">Service Date</th>
                                        <th class="gridjs-th">Lost Amount</th>
                                        <th class="gridjs-th">Description</th>
                                        <th class="gridjs-th">Hub</th>
                                    </tr>
                                </thead>
                                <tbody class="gridjs-tbody">
                                    <?php
                                    if (!empty($lostDeliveries)):
                                        $i = 1;
                                        $totalLost = 0;
                                    ?>
                                        <?php foreach ($lostDeliveries as $row): ?>
                                            <?php $totalLost += $row['lost_amount']; ?>
                                            <tr class="gridjs-tr">
                                                <td class="gridjs-td"><?= $i++ ?></td>
                                                <td class="gridjs-td"><?= esc($row['staff_name']) ?></td>
                                                <td class="gridjs-td"><?= date('d M Y', strtotime($row['service_date'])) ?></td>
                                                <td class="gridjs-td"><?= number_format($row['lost_amount']) ?> INR</td>
                                                <td class="gridjs-td">
                                                    <?= !empty($row['lost_description']) ? esc($row['lost_description']) : '<i>No description</i>' ?>
                                                </td>
                                                <td class="gridjs-td"><?= esc($row['hub_name']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No lost deliveries found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>

                                <?php if (!empty($lostDeliveries)): ?>
                                    <tfoot class="gridjs-tfoot">
                                        <tr class="gridjs-tr" style="background-color: #f2f2f2; font-weight: bold;">
                                            <td class="gridjs-td" colspan="3">Total Lost Amount</td>
                                            <td class="gridjs-td"><?= number_format($totalLost) ?> INR</td>
                                            <td class="gridjs-td" colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                <?php endif; ?>
                            </table>

                            <div class="gridjs-footer">
                                <div class="gridjs-pagination">
                                    <?= $pager->makeLinks(1, 10, $totalRecords, 'default_full') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>