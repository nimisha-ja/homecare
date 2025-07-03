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
                            <form action="<?= base_url('/addstaff') ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Staff Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter staff's name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nick Name</label>
                                            <input type="text" name="nickname" id="nickname" class="form-control" required placeholder="Enter staff's name">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" id="email" class="form-control"  placeholder="Enter staff's email">
                                            <div id="emailHelp" class="form-text">
                                                We'll never share your email with anyone else.
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" name="phone" id="phone" class="form-control" required placeholder="Enter staff's phone number">
                                            <div id="phoneHelp" class="form-text">
                                                We'll never share your phone number with anyone else.
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (session()->get('role_id') == 1): ?>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="role_id" class="form-label">Hub</label>
                                                <select name="hub" id="hub" class="form-select">
                                                    <option value="">Select Hub</option>
                                                    <?php foreach ($hubs as $hub): ?>
                                                        <option value="<?= esc($hub['hub_id']) ?>"><?= esc($hub['hub_name']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Staff Image</label>
                                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Pan Card</label>
                                            <input type="file" name="pancard" id="pancard" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Licence</label>
                                            <input type="file" name="licence" id="licence" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Insurance </label>
                                            <input type="file" name="insurance" id="insurance" class="form-control" accept="image/*">
                                        </div>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label"> Aadhaar Card </label>
                                            <input type="file" name="aadhaarcard" id="aadhaarcard" class="form-control" accept="image/*" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Bank Account Number</label>
                                            <input type="text" name="bankaccountnumber" id="bankaccountnumber" class="form-control" required placeholder="Enter staff's name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name of Bank</label>
                                            <input type="text" name="bankname" id="bankname" class="form-control" required placeholder="Enter staff's name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">IFSC</label>
                                            <input type="text" name="ifsc" id="ifsc" class="form-control" required placeholder="Enter staff's name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Status</label>
                                            <select id="ForminputState" name="status" class="form-select" data-choices data-choices-sorting="true">
                                                <?php foreach ($statusOptions as $status): ?>
                                                    <option value="<?= esc($status) ?>"><?= esc(ucwords($status)) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Add Staff</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>