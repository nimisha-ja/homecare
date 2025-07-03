<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Hubs</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hubs</a></li>
                            <li class="breadcrumb-item active">Hub Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1">Hub</h4>
                    </div>
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
                    <div class="card-body">
                        <div id="table-gridjs">
                            <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                                <div class="gridjs-head">
                                    <div class="gridjs-search">
                                        <input type="search" id="search-bar" placeholder="Search users..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input">
                                    </div>
                                </div>
                                <div class="gridjs-wrapper" style="height: auto;">
                                    <table id="users-table" role="grid" class="gridjs-table" style="height: auto; text-align: center;">
                                        <thead class="gridjs-thead">
                                            <tr class="gridjs-tr">
                                                <th data-column-id="id" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 80px;">
                                                    <div class="gridjs-th-content">#</div>
                                                </th>
                                               
                                                <th data-column-id="hub" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 180px;">
                                                    <div class="gridjs-th-content">Hub</div>
                                                </th>
                                              
                                                <th data-column-id="actions" class="gridjs-th gridjs-th-sort" tabindex="0" style="width: 150px;">
                                                    <div class="gridjs-th-content">Actions</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="gridjs-tbody">
                                            <?php $serialNo = 1; ?>
                                            <?php foreach ($hubs as $index => $hub): ?>
                                                <tr class="gridjs-tr align-middle">
                                                    <td data-column-id="id" class="gridjs-td"><?= $serialNo++; ?></td>
                                                    <td data-column-id="name" class="gridjs-td"><?= esc($hub['hub_name']) ?></td>                                                 
                                                    <td data-column-id="actions" class="gridjs-td">
                                                        <div class="d-flex flex-wrap justify-content-start">
                                                            <a href="<?= base_url('/hub/edit/' . $hub['hub_id']) ?>" title="Edit" style="font-size: 20px;">
                                                                <i class="ri-file-edit-line"></i>
                                                            </a>
                                                            <form action="<?= site_url('/hub/delete/' . $hub['hub_id']) ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this hub?');">
                                                                <?= csrf_field() ?>
                                                                <button type="submit" style="border: none; background: none;">
                                                                    <i class="ri-delete-bin-6-line" style="font-size: 20px;"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Add search functionality for Grid.js
    const searchInput = document.getElementById('search-bar');
    const table = document.getElementById('users-table');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const columns = row.querySelectorAll('td');
            const nameColumn = columns[1].textContent.toLowerCase();
            const emailColumn = columns[2].textContent.toLowerCase();
            const hubColumn = columns[3].textContent.toLowerCase();
            const roleColumn = columns[4].textContent.toLowerCase();

            if (nameColumn.includes(query) || emailColumn.includes(query) || hubColumn.includes(query)|| roleColumn.includes(query)) {
                row.style.display = ''; // Show row if it matches the search query
            } else {
                row.style.display = 'none'; // Hide row if it doesn't match
            }
        });
    });
</script>