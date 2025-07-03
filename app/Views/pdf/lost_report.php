<!-- <h2>Lost Deliveries Report</h2>
<p>From:</p> -->

<table border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th>#</th>
            <th>Staff ID</th>
            <th>Service Date</th>
            <th>Hub</th>
            <th>Lost Amount</th>
            <th>Lost Description</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($lostDeliveries as $delivery): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($delivery['staff_name']) ?></td>
                <td><?= esc($delivery['service_date']) ?></td>
                <td><?= esc($delivery['hub_name'] ?? '') ?></td>
                <td><?= esc($delivery['lost_amount']) ?></td>
                <td><?= esc($delivery['lost_description']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
