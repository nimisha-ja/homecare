<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Edit Family Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Family Management</a></li>
                            <li class="breadcrumb-item active">Edit Family</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Family Details</h4>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <div class="live-preview">
                            <form action="<?= site_url('family/update/' . $family['family_id']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="row">

                                    <!-- Family Code -->
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Family Code</label>
                                            <input type="text" name="family_code" class="form-control" value="<?= esc($family['family_code']) ?>" required>
                                        </div>
                                    </div> -->

                                    <!-- Family Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Family Name</label>
                                            <input type="text" name="family_name" class="form-control" value="<?= esc($family['family_name']) ?>" required>
                                        </div>
                                    </div>

                                    <!-- Head of Family -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Head of Family</label>
                                            <input type="text" name="head_of_family" class="form-control" value="<?= esc($family['head_of_family']) ?>" required>
                                        </div>
                                    </div>

                                    <!-- Members Count -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Members Count</label>
                                            <input type="number" name="members_count" class="form-control" value="<?= esc($family['members_count']) ?>" required>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" class="form-control" rows="2"><?= esc($family['address']) ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" value="<?= esc($family['contact_number']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="family_email" class="form-label">Family Email</label>
                                            <input type="email" name="family_email" class="form-control" id="family_email" value="<?= esc($family['family_email']) ?>">
                                            <!-- <small class="form-text text-muted">Email is read only type(login).</small>  -->
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" name="password" class="form-control" id="password" value="<?= esc($family['password']) ?>">
                                            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                        </div>
                                    </div>
                                    <!-- Registered On -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Registered On</label>
                                            <input type="date" name="registered_on" class="form-control" value="<?= esc($family['registered_on']) ?>">
                                        </div>
                                    </div>

                                    <!-- Photo URL -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Photo URL</label>
                                            <input type="file" name="photo" class="form-control" value="<?= esc($family['photo']) ?>">

                                            <?php if (!empty($family['photo'])): ?>
                                                <img src="<?= base_url('uploads/family/' . $family['photo']) ?>" style="height:100px;width:100px">
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <!-- Members -->
                                    <div class="col-md-12">
                                        <h5 class="mt-4">Family Members</h5>
                                        <div id="members-wrapper" class="row g-3">
                                            <?php foreach ($members as $index => $member): ?>
                                                <div class="member row g-3 mb-3">
                                                    <div class="col-md-4">
                                                        <input type="text" name="members[<?= $index ?>][full_name]" class="form-control" placeholder="Full Name" value="<?= esc($member['full_name']) ?>" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="members[<?= $index ?>][relation_to_head]" class="form-control" placeholder="Relation" value="<?= esc($member['relation_to_head']) ?>">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" name="members[<?= $index ?>][date_of_birth]" class="form-control" value="<?= esc($member['date_of_birth']) ?>">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="members[<?= $index ?>][gender]" class="form-control" placeholder="Gender" value="<?= esc($member['gender']) ?>">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="members[<?= $index ?>][job]" class="form-control" placeholder="Job" value="<?= esc($member['job']) ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="members[<?= $index ?>][education]" class="form-control" placeholder="Education" value="<?= esc($member['education']) ?>">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="members[<?= $index ?>][current_status]" class="form-control" placeholder="Status" value="<?= esc($member['current_status']) ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <button type="button" class="btn btn-outline-secondary btn-sm mt-3" onclick="addMember()">+ Add Another Member</button>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-lg-12 mt-4">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Update Family</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- JS to dynamically add members -->
                        <script>
                            let memberIndex = <?= count($members) ?>;

                            function addMember() {
                                const wrapper = document.getElementById('members-wrapper');
                                const div = document.createElement('div');
                                div.classList.add('member', 'row', 'g-3', 'mt-2');
                                div.innerHTML = `
                                    <div class="col-md-4">
                                        <input type="text" name="members[\${memberIndex}][full_name]" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="members[\${memberIndex}][relation_to_head]" class="form-control" placeholder="Relation">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="members[\${memberIndex}][date_of_birth]" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="members[\${memberIndex}][gender]" class="form-control" placeholder="Gender">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="members[\${memberIndex}][job]" class="form-control" placeholder="Job">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="members[\${memberIndex}][education]" class="form-control" placeholder="Education">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="members[\${memberIndex}][current_status]" class="form-control" placeholder="Status">
                                    </div>
                                `;
                                wrapper.appendChild(div);
                                memberIndex++;
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>