<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <h3 class="mb-3 text-center fw-bold">Issued Weapons List</h3>
    <div class="border border-primary p-3">
        <table id="issuedWeaponsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
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
                <!-- Data will be populated by DataTables via AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables Initialization Script -->
<script>
    $(document).ready(function() {
        $('#issuedWeaponsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('weapon-controller/get-issued-weapons') ?>", // Ensure this matches your route
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "weapon_id" },
                { "data": "weapon_name" },
                { "data": "employee_id" },
                { "data": "bullet_name" },
                { "data": "bullet_quantity" },
                { "data": "user_id" },
                { "data": "issue_date" },
                { "data": "return_date" },
                { "data": "status" }
            ]
        });
    });
</script>

<?= $this->endSection() ?>