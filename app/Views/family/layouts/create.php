<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Add Family Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> Add Family Details</a></li>
                            <li class="breadcrumb-item active">Add Family Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add Family Details</h4>
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
                                    <form action="<?= site_url('family/store') ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="family_name" class="form-label">Family Name</label>
                                                    <input type="text" name="family_name" class="form-control" id="family_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="head_of_family" class="form-label">Head of Family</label>
                                                    <input type="text" name="head_of_family" class="form-control" id="head_of_family" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="members_count" class="form-label">Members Count</label>
                                                    <input type="number" name="members_count" class="form-control" id="members_count" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="contact_number" class="form-label">Contact Number</label>
                                                    <input type="text" name="contact_number" class="form-control" id="contact_number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="family_email" class="form-label">Family Email</label>
                                                    <input type="email" name="family_email" class="form-control" id="family_email" value="<?= isset($family['family_email']) ? esc($family['family_email']) : '' ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control" id="password" <?= isset($family) ? '' : 'required' ?>>
                                                    <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                                </div>
                                            </div>

                                            <!-- Registered On -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="registered_on" class="form-label">Registered On</label>
                                                    <input type="date" name="registered_on" class="form-control" id="registered_on">
                                                </div>
                                            </div>

                                            <!-- Photo URL -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="photo_url" class="form-label">Photo URL</label>
                                                    <input type="file" accept=".pdf,.jpg,.jpeg,.png" name="photo" class="form-control" id="photo">
                                                </div>
                                            </div>

                                            <!-- Family Members Section -->
                                            <div class="col-md-12">
                                                <h5 class="mt-4">Family Members</h5>
                                                <div id="members-wrapper" class="row g-3">

                                                    <div class="member row g-3">
                                                        <div class="col-md-4">
                                                            <input type="text" name="members[0][full_name]" class="form-control" placeholder="Full Name" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="members[0][relation_to_head]" class="form-control" placeholder="Relation">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="date" name="members[0][date_of_birth]" class="form-control" placeholder="DOB">
                                                            <small class="form-text text-muted">Date Of Birth.</small>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="members[0][gender]" class="form-control" placeholder="Gender">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="members[0][job]" class="form-control" placeholder="Job">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" name="members[0][education]" class="form-control" placeholder="Education">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" name="members[0][current_status]" class="form-control" placeholder="Status">
                                                        </div>
                                                    </div>

                                                </div>

                                                <button type="button" class="btn btn-outline-secondary btn-sm mt-3" onclick="addMember()">+ Add Another Member</button>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-lg-12 mt-4">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Save Family</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <script>
                                let memberIndex = 1;

                                function addMember() {
                                    const wrapper = document.getElementById('members-wrapper');
                                    const div = document.createElement('div');
                                    div.classList.add('member', 'row', 'g-3', 'mt-2');
                                    div.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="members[${memberIndex}][full_name]" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="members[${memberIndex}][relation_to_head]" class="form-control" placeholder="Relation">
            </div>
            <div class="col-md-2">
                <input type="date" name="members[${memberIndex}][date_of_birth]" class="form-control" placeholder="DOB">
            </div>
            <div class="col-md-2">
                <input type="text" name="members[${memberIndex}][gender]" class="form-control" placeholder="Gender">
            </div>
            <div class="col-md-2">
                <input type="text" name="members[${memberIndex}][job]" class="form-control" placeholder="Job">
            </div>
            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][education]" class="form-control" placeholder="Education">
            </div>
            <div class="col-md-3">
                <input type="text" name="members[${memberIndex}][current_status]" class="form-control" placeholder="Status">
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
</div>