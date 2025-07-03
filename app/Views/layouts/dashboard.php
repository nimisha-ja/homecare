<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">CRM</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">CRM</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row g-0 p-4">
            <div class="col-md-4 border-end">
            </div>
            <?php if (!empty($family)) : ?>
                <div class="col-md-8">
                    <h4 class="mb-3">Family Details</h4>

                    <dl class="row">
                        <dt class="col-sm-4">Photo</dt>
                        <dd class="col-sm-8">
                            <?php if (!empty($family['photo']) && is_file(FCPATH . 'uploads/family/' . $family['photo'])): ?>
                                <img src="<?= base_url('uploads/family/' . $family['photo']) ?>"
                                    alt="Family Photo"
                                    style="height:150px; width:150px; object-fit:cover; border-radius:8px;">

                            <?php else: ?>
                                <span class="text-muted">No photo uploaded</span>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-sm-4">Family ID</dt>
                        <dd class="col-sm-8">
                            <?= esc($family['family_code']) ?>
                        </dd>
                        <dt class="col-sm-4">Family Name</dt>
                        <dd class="col-sm-8"> <?= esc($family['family_name']) ?></dd>

                        <dt class="col-sm-4">Head of Family</dt>
                        <dd class="col-sm-8"> <?= esc($family['head_of_family']) ?></dd>

                        <dt class="col-sm-4">Members Count</dt>
                        <dd class="col-sm-8"><?= esc($family['members_count']) ?></dd>

                        <dt class="col-sm-4">Address</dt>
                        <dd class="col-sm-8"><?= esc($family['address']) ?></dd>

                        <dt class="col-sm-4">Contact Number</dt>
                        <dd class="col-sm-8"><?= esc($family['contact_number']) ?></dd>

                        <dt class="col-sm-4">Registered On</dt>
                        <dd class="col-sm-8"><?= esc($family['registered_on']) ?></dd>
                    </dl>

                    <h5 class="mb-3">Members:</h5>
                    <ul>
                        <?php foreach ($members as $member): ?>
                            <li><?= esc($member['full_name']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else : ?>
                <H4>Welcome to the Church Administration Panel</H4>
                May this tool help you steward the ministry with wisdom, clarity, and compassion.
            <?php endif; ?>

        </div>



    </div>

</div>
</div>