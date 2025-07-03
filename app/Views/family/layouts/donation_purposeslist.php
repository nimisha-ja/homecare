<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Donation</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Donation</a></li>
                            <li class="breadcrumb-item active">Donation Purposes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Donation Purposes</h4>
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

                                    <table id="donation-purpose-table" role="grid" class="gridjs-table" style="height: auto; text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th class="gridjs-th" style="width: 60px;">
                                                    <div class="gridjs-th-content">#</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Title</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Description</div>
                                                </th>
                                                <th class="gridjs-th">
                                                    <div class="gridjs-th-content">Status</div>
                                                </th>
                                                <?php if (!session()->has('family_id')): ?>
                                                    <th class="gridjs-th">Action</th>
                                                <?php endif; ?>

                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $serial = 1; ?>
                                            <?php if (!empty($purposes) && is_array($purposes)): ?>
                                                <?php foreach ($purposes as $purpose): ?>
                                                    <tr class="gridjs-tr align-middle">
                                                        <td class="gridjs-td"><?= $serial++ ?></td>
                                                        <td class="gridjs-td"><?= esc($purpose['title']) ?></td>
                                                        <td class="gridjs-td"><?= esc($purpose['description']) ?></td>
                                                        <td class="gridjs-td"><?= $purpose['is_active'] ? 'Active' : 'Inactive' ?></td>
                                                     <?php if (!session()->has('family_id')): ?>   <td class="gridjs-td">
                                                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                                                <a href="<?= site_url('donationpurposes/edit/' . $purpose['id']) ?>" title="Edit">
                                                                    <i class="ri-file-edit-line" style="font-size: 18px;"></i>
                                                                </a>
                                                                <a href="<?= site_url('donationpurposes/delete/' . $purpose['id']) ?>" title="Delete" onclick="return confirm('Delete this purpose?')">
                                                                    <i class="ri-delete-bin-6-line" style="font-size: 18px; color: red;"></i>
                                                                </a>
                                                            </div>
                                                        </td><?php else: ?><?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="gridjs-tr">
                                                    <td class="gridjs-td" colspan="5">No donation purposes found.</td>
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