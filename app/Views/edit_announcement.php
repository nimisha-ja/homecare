<?= $this->include('common/header'); ?>
<div id="layout-wrapper">
    <?= $this->include('common/navbar'); ?>
    <?= $this->include('common/menu_view'); ?> 
    <div class="main-content">
        <?= $this->include('layouts/edit_announcement'); ?>
        <?= $this->include('common/footer'); ?>
    </div>
</div>
<?= $this->include('common/footerscript'); ?>