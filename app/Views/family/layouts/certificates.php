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
                        <h4 class="card-title mb-0 flex-grow-1">certificates</h4>
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
                                    <table id="family-table" role="grid" class="gridjs-table" style="height: auto; text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th" style="width: 60px;">
                                                    <div class="gridjs-th-content">#</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Family Code</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Certificate Type</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Status</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Family Name</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Head Of Family</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">created_at</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Appproval/Rejection</div>
                                                </th>

                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $serial = 1; ?>
                                            <?php if (!empty($certificates) && is_array($certificates)): ?>
                                              
                                                    <?php foreach ($certificates as $cert): ?>
                                                        <tr>
                                                            <td class="gridjs-td"><?= $serial++ ?></td>
                                                            <td class="gridjs-td"><?= esc($cert['family_code']) ?></td>
                                                            <td class="gridjs-td"><?= esc($cert['certificate_type']) ?></td>
                                                            <td class="gridjs-td"><?= esc($cert['status']) ?></td>
                                                            <td class="gridjs-td"><?= esc($cert['family_name']) ?></td>
                                                            <td class="gridjs-td"><?= esc($cert['head_of_family']) ?></td>
                                                            <td class="gridjs-td"><?= esc($cert['created_at']) ?></td>
                                                           <td>
            <a href="<?= site_url('family/approve-certificate/' . $cert['certificate_id']) ?>" 
               class="btn btn-sm btn-primary" title="Approve/Reject Certificate">
                Approve/Reject
            </a>
        </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                               
                                            <?php else: ?>
                                                <tr class="gridjs-tr">
                                                    <td class="gridjs-td" colspan="10">No families found.</td>
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



    </div>
</div>