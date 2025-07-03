<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Delivery Staff</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                            <li class="breadcrumb-item active">Add Staff</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Staff</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="<?= base_url('/staff/update/' . $staff['id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Staff Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="<?= esc($staff['name']) ?>" required placeholder="Enter staff's name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nick Name</label>
                                        <input type="text" name="nickname" id="nickname" class="form-control" value="<?= esc($staff['nickname']) ?>" required placeholder="Enter staff's name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" name="phone" id="phone" class="form-control" value="<?= esc($staff['phone']) ?>" required placeholder="Enter staff's phone number">
                                        <div id="phoneHelp" class="form-text">
                                            We'll never share your phone number with anyone else.
                                        </div>
                                    </div>
                                    <?php if (session()->get('role_id') == 1): ?>
                                        <div class="mb-3">
                                            <label for="hub" class="form-label">Hub</label>
                                            <select name="hub" id="hub" class="form-select">
                                                <option value="">Select Hub</option>
                                                <?php foreach ($hubs as $hub): ?>
                                                    <option value="<?= esc($hub['hub_id']) ?>" <?= ($hub['hub_id'] == $staff['hub']) ? 'selected' : '' ?>><?= esc($hub['hub_name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Status</label>
                                        <select id="ForminputState" name="status" class="form-select" data-choices data-choices-sorting="true">
                                            <option value="">Select Status</option>
                                            <?php foreach ($statusOptions as $status): ?>
                                                <option value="<?= esc($status) ?>" <?= (isset($staff['status']) && $staff['status'] == $status) ? 'selected' : '' ?>>
                                                    <?= esc(ucwords($status)) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Staff Image</label>
                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    </div>
                                    <?php if ($staff['image']): ?>
                                        <div class="mb-3">
                                            <p><strong>Current Image:</strong></p>
                                            <img src="<?= base_url($staff['image']); ?>" alt="Staff Image" width="70" />
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-3">
                                            <p><strong>No image uploaded. Default image will be used if no image is provided.</strong></p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Pan Card</label>
                                        <input type="file" name="pancard" id="pancard" class="form-control" accept="image/*">
                                    </div>
                                    <?php if ($staff['pancard']): ?>
                                        <div class="mb-3">
                                            <p><strong>Current Image:</strong></p>
                                            <img src="<?= base_url($staff['pancard']); ?>" alt="Staff Image" width="70" />
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-3">
                                            <p><strong>No image uploaded. Default image will be used if no image is provided.</strong></p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Licence</label>
                                        <input type="file" name="licence" id="licence" class="form-control" accept="image/*">
                                    </div>
                                    <?php if ($staff['licence']): ?>
                                        <div class="mb-3">
                                            <p><strong>Current Image:</strong></p>
                                            <img src="<?= base_url($staff['licence']); ?>" alt="Staff Image" width="70" />
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-3">
                                            <p><strong>No image uploaded. Default image will be used if no image is provided.</strong></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Insurance </label>
                                        <input type="file" name="insurance" id="insurance" class="form-control" accept="image/*">
                                    </div>
                                    <?php if ($staff['insurance']): ?>
                                        <div class="mb-3">
                                            <p><strong>Current Image:</strong></p>
                                            <img src="<?= base_url($staff['insurance']); ?>" alt="Staff Image" width="70" />
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-3">
                                            <p><strong>No image uploaded. Default image will be used if no image is provided.</strong></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label for="image" class="form-label"> Aadhaar Card </label>
                                        <input type="file" name="aadhaarcard" id="aadhaarcard" class="form-control" accept="image/*">
                                    </div>
                                    <?php if ($staff['aadhaarcard']): ?>
                                        <div class="mb-3">
                                            <p><strong>Current Image:</strong></p>
                                            <img src="<?= base_url($staff['aadhaarcard']); ?>" alt="Staff Image" width="70" />
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-3">
                                            <p><strong>No image uploaded. Default image will be used if no image is provided.</strong></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Bank Account Number</label>
                                        <input type="text" name="bankaccountnumber" id="bankaccountnumber" value="<?= esc($staff['bankaccountnumber']) ?>" class="form-control" required placeholder="Enter staff's name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name of Bank</label>
                                        <input type="text" name="bankname" id="bankname" class="form-control" required placeholder="Enter staff's name" value="<?= esc($staff['bankname']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">IFSC</label>
                                        <input type="text" name="ifsc" id="ifsc" value="<?= esc($staff['ifsccode']) ?>"
                                            class="form-control" required placeholder="Enter staff's name">
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Staff</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>