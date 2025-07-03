<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Donation </h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Donation </a></li>
                            <li class="breadcrumb-item active">Donation /li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Donation </h4>
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
                                    <h2> Donation </h2>
                                    <div class="row">
                                        <form method="post" action="<?= site_url('donations/update/' . $donation['id']) ?>">
                                            <?= csrf_field() ?>
                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="form-label">Family</label>
                                                    <select name="family_id" class="form-control" required>
                                                        <?php foreach ($families as $family): ?>
                                                            <option value="<?= $family['family_id'] ?>" <?= $donation['family_id'] == $family['family_id'] ? 'selected' : '' ?>>
                                                                <?= esc($family['family_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Purpose</label>
                                                    <select name="purpose_id" class="form-control" required>
                                                        <?php foreach ($purposes as $purpose): ?>
                                                            <option value="<?= $purpose['id'] ?>" <?= $donation['purpose_id'] == $purpose['id'] ? 'selected' : '' ?>>
                                                                <?= esc($purpose['title']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Amount</label>
                                                    <input type="number" step="0.01" name="amount" class="form-control" value="<?= esc($donation['amount']) ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Date</label>
                                                    <input type="date" name="donation_date" class="form-control" value="<?= esc($donation['donation_date']) ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Notes</label>
                                                    <textarea name="notes" class="form-control"><?= esc($donation['notes']) ?></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Donation</button>
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