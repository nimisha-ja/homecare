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
                                    <h3>Approve or Reject Certificate Request</h3>
                                    <form action="<?= site_url('family/approve-certificate-action/' . $certificate['id']) ?>"
                                        method="post" enctype="multipart/form-data">

                                        <label>Status</label>
                                        <select name="status" onchange="toggleFileUpload(this.value)" required>
                                            <option value="">-- Select --</option>
                                            <option value="Approved">Approve</option>
                                            <option value="Rejected">Reject</option>
                                        </select>
                                        <div id="uploadField" style="display:none; margin-top:10px;">
                                            <label>Upload Certificate (PDF/Image):</label>
                                            <input type="file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png" />
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <script>
                                        function toggleFileUpload(status) {
                                            document.getElementById('uploadField').style.display = status === 'Approved' ? 'block' : 'none';
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>