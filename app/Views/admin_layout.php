<?= $this->include('common/header'); ?>
<div id="layout-wrapper">
    <?= $this->include('common/navbar'); ?>
    <?= $this->include('common/menu_view'); ?> <!-- Sidebar -->
    <!-- Content Wrapper -->

    <div class="main-content">
        <?= $this->include('layouts/dashboard'); ?>
        <!-- Footer -->
        <?= $this->include('common/footer'); ?>
    </div>
</div>
<?= $this->include('common/footerscript'); ?>
<!-- END layout-wrapper -->