<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Donation</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Donations</a></li>
                            <li class="breadcrumb-item active">Add Donation</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add Donation</h4>
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
                    </div>
                    <div class="card-body">
                        <div class="live-preview">

                            <div class="card-body">
                                <div class="live-preview">
                                    <h2>Add Donation Purpose</h2>
                                    <div class="row">
                                        <form method="post" action="<?= site_url('payment/proceed') ?>">
                                            <?= csrf_field() ?>
                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label for="family_id" class="form-label">Family</label>
                                                    <input type="text" class="form-control" value="<?= session('family_name') ?>" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="purpose_id" class="form-label">Donation Purpose</label>
                                                    <select name="purpose_id" id="purpose_id" class="form-control" required>
                                                        <option value="">-- Select Purpose --</option>
                                                        <?php foreach ($purposes as $purpose): ?>
                                                            <option value="<?= $purpose['id'] ?>"><?= esc($purpose['title']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="donation_date" class="form-label">Donation Date</label>
                                                    <input type="date" name="donation_date" id="donation_date" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="notes" class="form-label">Notes (optional)</label>
                                                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-success">Save Donation</button>
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
        </div>
    </div>
</div>