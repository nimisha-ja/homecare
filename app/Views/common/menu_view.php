<div class="app-menu navbar-menu">

    <div class="navbar-brand-box">
        <a href="<?= base_url('/dashboard'); ?>" class="logo logo-dark">
        </a>
        <a href="<?= base_url('/dashboard'); ?>" class="logo logo-light">
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="<?= base_url('public/assets/images/users/avatar-1.jpg'); ?>" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Gloria <?php echo ucfirst(session()->get('username')); ?></span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Welcome </h6>
            <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a> -->
            <a class="dropdown-item" href="<?= base_url('/logout'); ?>"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>

        </div>
    </div>


    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <?php foreach ($menus as $menu): ?>
                    <?php if (empty($menu['submenus'])): ?> <!-- Menu without submenus (simple link) -->
                        <li class="nav-item <?= (current_url() == base_url($menu['url'])) ? 'active' : ''; ?>">
                            <a class="nav-link menu-link" href="<?= base_url($menu['url']); ?>" role="button">
                                <i class="<?= $menu['icon']; ?>"></i>
                                <span data-key="<?= $menu['name']; ?>"><?= $menu['name']; ?></span>
                            </a>
                        </li>
                    <?php else: ?> <!-- Menu with submenus (collapsible) -->
                        <li class="nav-item <?= (current_url() == base_url($menu['url'])) ? 'active' : ''; ?>">
                            <a class="nav-link menu-link" href="#sidebar<?= $menu['id']; ?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar<?= $menu['id']; ?>">
                                <i class="<?= $menu['icon']; ?>"></i>
                                <span data-key="<?= $menu['name']; ?>"><?= $menu['name']; ?></span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebar<?= $menu['id']; ?>">
                                <ul class="nav nav-sm flex-column">
                                    <?php foreach ($menu['submenus'] as $submenu): ?>
                                        <li class="nav-item <?= (current_url() == base_url($submenu['url'])) ? 'active' : ''; ?>">
                                            <a href="<?= base_url($submenu['url']); ?>" class="nav-link"><?= $submenu['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>