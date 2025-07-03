<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Privileges</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Privileges</a></li>
                            <li class="breadcrumb-item active">Add Privileges</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Assign Privileges</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="<?= base_url('/save_privileges') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="users" class="form-label">Select Roles</label>
                                            <select name="role_id" id="role_id" class="form-select" required>
                                                <option value="">Select</option>
                                                <?php foreach ($roles as $role): ?>
                                                    <option value="<?= esc($role['id']); ?>">
                                                        <?= esc($role['role_name']); ?> (<?= esc($role['role_name']); ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Menus Selection Section -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="menus" class="form-label">Assign Menus</label>
                                            <div class="row">
                                                <?php foreach ($all_menus as $menu): ?>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="menu_ids[]" value="<?= esc($menu['id']); ?>" id="menu_<?= esc($menu['id']); ?>">
                                                            <label class="form-check-label fw-bold" for="menu_<?= esc($menu['id']); ?>">
                                                                <?= esc($menu['name']); ?>
                                                            </label>
                                                        </div>

                                                        <?php if (!empty($menu['submenus'])): ?>
                                                            <div class="ms-4 mt-2">
                                                                <?php foreach ($menu['submenus'] as $submenu): ?>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="menu_ids[]" value="<?= esc($submenu['id']); ?>" id="menu_<?= esc($submenu['id']); ?>">
                                                                        <label class="form-check-label" for="menu_<?= esc($submenu['id']); ?>">
                                                                            <?= esc($submenu['name']); ?>
                                                                        </label>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Save Privileges</button>
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