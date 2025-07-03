<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10pt;
    }
    th, td {
        border: 1px solid #000;
        padding: 6px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

<h2>Staff List Report</h2>
<table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Hub</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $serial = 1; ?>
        <?php foreach ($staff as $s): ?>
        <tr>
            <td><?= $serial++ ?></td>
            <td><?= $s['name'] ?></td>
            <td><?= $s['phone'] ?></td>
            <td><?= $s['hub_name'] ?></td>
            <td><?= $s['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
