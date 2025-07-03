<div class="page-content">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Accounts</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Accounts</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="<?= site_url('/user/update/' . $user['id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="username" value="<?= esc($user['username']) ?>" required placeholder="Enter username">
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="email" value="<?= esc($user['email']) ?>" required placeholder="Enter email address">
                                            <div id="emailHelp" class="form-text">
                                                We'll never share your email with anyone else.
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Leave empty to keep current password">
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="role_id" class="form-label">Role</label>
                                            <select name="role_id" id="role_id" class="form-select" required>
                                                <option value="">Select Role</option>
                                                <?php foreach ($roles as $role): ?>
                                                    <option value="<?= esc($role['id']) ?>" <?= ($role['id'] == $user['role_id']) ? 'selected' : '' ?>>
                                                        <?= esc($role['role_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hub" class="form-label">Hubs</label>
                                            <select name="hub" id="hub" class="form-select" required>
                                                <option value="">Select Hub</option>
                                                <?php foreach ($hubs as $hub): ?>
                                                    <option value="<?= esc($hub['hub_id']) ?>" <?= ($hub['hub_id'] == $user['hub']) ? 'selected' : '' ?>><?= esc($hub['hub_name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
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