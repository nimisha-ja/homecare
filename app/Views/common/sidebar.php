<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->

        <a href="<?= base_url('admin/dashboard'); ?>" class="logo logo-dark">
            <!-- <span class="logo-sm">
                <img src="<?= base_url('public/assets/images/Meesho_logo.png'); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= base_url('public/assets/images/Meesho_logo.png'); ?>" alt="" height="17">
            </span> -->
        </a>
        <!-- Light Logo-->
        <a href="<?= base_url('admin/dashboard'); ?>" class="logo logo-light">
            <!-- <span class="logo-sm">
                <img src="<?= base_url('public/assets/images/Meesho_logo.png'); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= base_url('public/assets/images/Meesho_logo.png'); ?>" alt="" height="60">
            </span> -->
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
            <!-- item-->
            <h6 class="dropdown-header">Welcome </h6>
            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="<?= base_url('admin/logout'); ?>"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>

        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?= base_url('admin/dashboard'); ?>" role="button">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarInventory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInventory">
                        <i class="ri-store-2-line"></i> <span data-key="t-report">Inventory </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarInventory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addinventory') ?>" class="nav-link">Add Inventory </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/inventorylist') ?>" class="nav-link">Inventory List</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/inventory-pending') ?>" class="nav-link">Pending Delivery List</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addrto-pickup') ?>" class="nav-link">Add RTO/PickUp </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/rto-pickuplist') ?>" class="nav-link"> RTO/PickUp List</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/rto-pickup-pending') ?>" class="nav-link"> RTO/PickUp Pending List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarHub" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarHub">
                        <i class="ri-home-fill"></i> <!-- You can change this to any other icon -->
                        <span data-key="t-hub">Hub</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarHub">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addhub') ?>" class="nav-link">Add Hub</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/hubslist') ?>" class="nav-link">Hub List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <?php //if (session()->get('role_id') == 1): 
                ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAccounts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccounts">
                        <i class="ri-wallet-line"></i> <span data-key="t-accounts">User Accounts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAccounts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/adduser'); ?>" class="nav-link">Add User Account</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/useraccounts'); ?>" class="nav-link">User Account List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPrivileges" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPrivileges">
                        <i class="ri-key-line"></i> <span data-key="t-privileges">Privileges</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPrivileges">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addprivilages'); ?>" class="nav-link">Add Privilege</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/listPrivileges'); ?>" class="nav-link">Privilege List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <?php //endif; 
                ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Staff Management</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/newstaff'); ?>" class="nav-link" data-key="t-chat"> Add Staff </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/staffmanagement'); ?>" class="nav-link" data-key="t-chat"> Staff Details </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDailyOfficeBook" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDailyOfficeBook">
                        <i class="ri-book-line"></i> <span data-key="t-daily-office-book">Daybook</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDailyOfficeBook">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addexpensecategories'); ?>" class="nav-link">Add Expense Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/expensecategorylist'); ?>" class="nav-link">Expense Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addexpenses'); ?>" class="nav-link">Add Expences</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/expenseslist'); ?>" class="nav-link">Expences List</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addincomecategories'); ?>" class="nav-link">Add Income Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/incomecategorylist'); ?>" class="nav-link">Income Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/addincome'); ?>" class="nav-link">Add Income</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/incomelist'); ?>" class="nav-link">Income List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-takeaway-line"></i> <span data-key="t-authentication">Operations Management</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url(' admin/adddeliveries'); ?>" class="nav-link">Add Activity
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/deliverylist'); ?>" class="nav-link"> List Activities
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSalaryManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSalaryManagement">
                        <i class="ri-hand-coin-line"></i> <span data-key="t-salary-management">Salary Management</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSalaryManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/listbasicpay') ?>" class="nav-link">Basic Pay</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="<?= base_url('admin/staff/addadvancepayment') ?>" class="nav-link">Add Advance Payment</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/staff/advancepayments') ?>" class="nav-link">Advance Payment List</a>
                            </li> -->
                            <li class="nav-item">
                                <a href="<?= base_url('admin/staff/salaries') ?>" class="nav-link">Salary List</a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarReport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReport">
                        <i class="ri-rhythm-line"></i> <span data-key="t-report">Report</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarReport">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/deliveryoperationsreport') ?>" class="nav-link">Deleveries Reportt</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/dailypaymentreport') ?>" class="nav-link">Daily Report</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>