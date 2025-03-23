<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<!-- Content of the Dashboard -->
<div class="container mt-5">
    <h1>Bullets Detail</h1>
    <table id="myTable" class="display" data-user-role="<?= session()->get('role') ?>">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bullet Type</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated by DataTables via AJAX -->
        </tbody>
    </table>
</div>


<!-- DataTables Initialization Script -->
<script>
    $(document).ready(function() {
        // Get the user's role from the table's data attribute
    var userRole = $('#myTable').data('user-role');

    var table = $('#myTable').DataTable({
            "processing": true, // Enable processing indicator
            "serverSide": true, // Enable server-side processing
            "ajax": {
                "url": "<?= base_url('BulletsController/search') ?>", // Endpoint for server-side data
                "type": "POST" // HTTP method
            },
            "columns": [
                { "data": "id" }, // Map to 'id' field in response
                { "data": "name" }, // Map to 'name' field in response
                { "data": "Quantity" }, // Map to 'Quantity' field in response
                { 
                    "data": "action", // Map to 'action' field in response
                    "orderable": false, // Disable sorting for action column
                    "searchable": false // Disable searching for action column
                }
            ],
            "order": [[0, 'asc']] // Default sorting by the first column (ID)
        });
        // Hide columns based on the user's role
    if (userRole === "admin") {
       // table.column(0).visible(false); // Hide column 0 (id)
       // table.column(5).visible(false); // Hide column 4 (action)
    } else if (userRole === "user") {
        table.column(0).visible(false); // Hide column 0 (id)
       // table.column(4).visible(false); // Hide column 4 (action)
    }
    });
</script>

<?= $this->endSection() ?>