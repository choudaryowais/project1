<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">

    <h1>Weapons Stats</h1>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Weapon ID</th>
                <th>Weapon Name</th>
                <th>Employee ID</th>
                <th>Bullet Name</th>
                <th>Bullet Quantity</th>
                <th>User ID</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($issuedWeapons as $weapon): ?>
            <tr>
                <td><?= $weapon['weapon_id']; ?></td>
                <td><?= $weapon['weapon_name']; ?></td>
                <td><?= $weapon['employee_id']; ?></td>
                <td><?= $weapon['bullet_name']; ?></td>
                <td><?= $weapon['bullet_quantity']; ?></td>
                <td><?= $weapon['user_id']; ?></td>
                <td><?= $weapon['issue_date']; ?></td>
                <td><?= $weapon['return_date']; ?></td>
                <td><?= $weapon['status']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>



<?= $this->endSection() ?>