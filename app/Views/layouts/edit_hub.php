<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Hubs</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hubs</a></li>
                            <li class="breadcrumb-item active">Edit Hub</li>
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
                            <form action="<?= site_url('/hub/update/' . $chub['hub_id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hub" class="form-label">Hub Name</label>
                                            <input type="text" name="hub" class="form-control" id="hub" value="<?= esc($chub['hub_name']) ?>" required placeholder="Enter hubname">
                                        </div>
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