<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<!-- Content of the Dashboard -->
<div class="container mt-5">
    <h1>Bullets Detail</h1>
    <!-- Button to count bullets (floated to the right) -->
    <button id="countBulletsBtn" class="btn btn-primary mb-3 float-end">Count Bullets by Type</button>

    <!-- Clear float to prevent layout issues -->
    <div class="clearfix"></div>

    <!-- Placeholder to display the result -->
    <div id="bulletCountResult" class="alert alert-info" style="display: none;">
        <button type="button" class="btn-close float-end" aria-label="Close"></button>
        <div id="bulletCountContent"></div>
    </div>

    <table id="myTable" class="display" data-user-role="<?= session()->get('role') ?>">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bullet Type</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated by DataTables via AJAX -->
        </tbody>
    </table>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="bulletModal" tabindex="-1" aria-labelledby="bulletModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulletModalLabel">Bullet Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="bulletDetails"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- DataTables Initialization Script -->
<script>
    $(document).ready(function() {
        // Get the user's role from the table's data attribute
        var userRole = $('#myTable').data('user-role');

        // Initialize DataTables
        var table = $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('BulletsController/search') ?>",
                "type": "POST",
                "dataSrc": function(json) {
                    console.log("Server response: ", json); // Debugging log
                    if (!json.data) {
                        alert("Unexpected server response format. Please check the server response.");
                        return [];
                    }
                    return json.data;
                },
                "error": function(xhr, error, thrown) {
                    console.log("Error occurred while loading data: ", error);
                    console.log("Response: ", xhr.responseText);
                }
            },
            "columns": [
                { "data": "id" }, // Map to 'id' field in response
                { "data": "name" }, // Map to 'name' field in response
                { "data": "Quantity" }, // Map to 'Quantity' field in response
                { 
                    "data": "status", // Map to 'status' field in response
                    "render": function(data, type, row) {
                        var color = '';
                        if (data === 'Available') {
                            color = 'green';
                        } else if (data === 'Issued') {
                            color = 'orange';
                        } else {
                            color = 'red';
                        }
                        return '<span style="background-color:' + color + '; color: white; padding: 5px; border-radius: 3px;">' + data + '</span>';
                    },
                    "orderable": false, // Disable sorting for status column
                    "searchable": false // Disable searching for status column
                },
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
            table.column(4).visible(false); // Hide column 0 (id)
            // table.column(4).visible(false); // Hide column 4 (action)
        }

        // Handle button click to count bullets by type
        $('#countBulletsBtn').click(function() {
            var bulletTypes = table.column(1).data().toArray(); // Get all bullet types from the "Bullet Type" column
            var bulletCounts = {};

            // Count occurrences of each bullet type
            bulletTypes.forEach(function(type) {
                if (bulletCounts[type]) {
                    bulletCounts[type]++;
                } else {
                    bulletCounts[type] = 1;
                }
            });

            // Display the result
            var resultHtml = '<strong>Bullet Counts:</strong><br>';
            for (var type in bulletCounts) {
                resultHtml += type + ': ' + bulletCounts[type] + '<br>';
            }
            $('#bulletCountContent').html(resultHtml);
            $('#bulletCountResult').show();
        });

        // Handle close button click to hide the result
        $('#bulletCountResult .btn-close').click(function() {
            $('#bulletCountResult').hide();
        });

        // Handle button click to fetch and display bullet details
        $('#myTable tbody').on('click', '.btn-details', function() {
            var bulletId = $(this).data('id');
            $.ajax({
                url: '<?= base_url('BulletsController/details') ?>/' + bulletId,
                type: 'GET',
                success: function(response) {
                    if (response.totalBullets !== undefined) {
                        $('#bulletDetails').text('Total number of bullets: ' + response.totalBullets);
                    } else {
                        $('#bulletDetails').text('Error: ' + response.error);
                    }
                    $('#bulletModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching bullet details: ', error);
                }
            });
        });

        // Reload DataTable every 30 seconds to fetch updated data
        setInterval(function() {
            table.ajax.reload(null, false); // Reload DataTable without resetting pagination
        }, 30000); // 30 seconds
    });
</script>

<?= $this->endSection() ?>