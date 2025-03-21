<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<?php $position = session()->get('position'); ?>

<div class="container mt-5">
    <h1>Weapons Detail</h1>
    <!-- Button to count weapons (floated to the right) -->
    <button id="countWeaponsBtn" class="btn btn-primary mb-3 float-end">Count Weapons by Name</button>

    <!-- Clear float to prevent layout issues -->
    <div class="clearfix"></div>

    <!-- Placeholder to display the result -->
    <div id="weaponCountResult" class="alert alert-info" style="display: none;">
        <button type="button" class="btn-close float-end" aria-label="Close"></button>
        <div id="weaponCountContent"></div>
    </div>

    <table id="myTable" class="display" data-user-role="<?= session()->get('role') ?>">
        <thead>
            <tr>
                <th>Serial No</th> <!-- New column for serial number -->
                <th>Weapon id</th>
                <th>Weapon Name</th>
                <th>Weapon Type</th>
                <th>Weapon Number</th>
                <th>Weapon Status</th>
                <th>Actions</th> <!-- This is for the buttons -->
                <th>Insert Action</th> <!-- New column for the Insert button -->
                <th>PS</th>
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
        var position = "<?= $position ?>";

        // Initialize DataTables
        var table = $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('weapon/search') ?>",
                "type": "POST",
                "dataSrc": function(json) {
                    console.log("Server response: ", json);
                    if (!json.data) {
                        alert("Unexpected server response format. Please check the server response.");
                        return [];
                    }
                    // Filter out rows where status is 'Issued' only for users
                    if (userRole === 'user' && position === "issue") {
                        return json.data.filter(function(row) {
                            return row.status !== 'Issued';
                        });
                    }
                    return json.data;
                },
                "error": function(xhr, error, thrown) {
                    console.log("Error occurred while loading data: ", error);
                    console.log("Response: ", xhr.responseText);
                }
            },
            "columns": [
                { 
                    "data": null, // Use null for serial number (not tied to a specific field)
                    "render": function(data, type, row, meta) {
                        // meta.row gives the row index (starting from 0)
                        // Add 1 to start the serial number from 1
                        return meta.row + 1;
                    },
                    "orderable": false // Disable sorting for the serial number column
                },
                { "data": "id" }, // Map to 'id' field in response
                { "data": "name" }, // Map to 'name' field in response
                { "data": "type" }, // Map to 'type' field in response
                { "data": "weaponno" }, // Map to 'weaponno' field in response
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
                    "render": function(data, type, row) {
                        return data; // Render as HTML
                    },
                    "orderable": false, // Disable sorting for action column
                    "searchable": false // Disable searching for action column
                },
                { 
                    "data": "insert_action", // Map to 'insert_action' field in response
                    "render": function(data, type, row) {
                        return data; // Render as HTML
                    },
                    "orderable": false, // Disable sorting for insert_action column
                    "searchable": false // Disable searching for insert_action column
                },
                { "data": "police_station_id" } // Map to 'police_station_id' field in response
            ],
            "order": [[1, 'asc']] // Default sorting by the second column (Weapon Name)
        });

        // Hide columns based on the user's role
        if (userRole === "admin") {
            table.column(7).visible(false); // Hide column 5 (Insert Action) for admin
        } else if (userRole === "user" && position === "view") {
            table.column(1).visible(false); 
            table.column(6).visible(false); // Hide column 4 (Actions) for user
            table.column(7).visible(false);
            table.column(8).visible(false); // Hide column 4 (Actions) for user
        } else if (userRole === "user" && position === "issue") {
            table.column(1).visible(false); 
            table.column(6).visible(false); // Hide column 4 (Actions) for user
            table.column(8).visible(false); // Hide column 4 (Actions) for user
        }

        // Handle button click to count weapons by name
        $('#countWeaponsBtn').click(function() {
            var weaponNames = table.column(2).data().toArray(); // Get all weapon names from the "Weapon Name" column
            var weaponCounts = {};

            // Count occurrences of each weapon name
            weaponNames.forEach(function(name) {
                if (weaponCounts[name]) {
                    weaponCounts[name]++;
                } else {
                    weaponCounts[name] = 1;
                }
            });

            // Display the result
            var resultHtml = '<strong>Weapon Counts:</strong><br>';
            for (var name in weaponCounts) {
                resultHtml += name + ': ' + weaponCounts[name] + '<br>';
            }
            $('#weaponCountContent').html(resultHtml);
            $('#weaponCountResult').show();
        });

        // Handle close button click to hide the result
        $('#weaponCountResult .btn-close').click(function() {
            $('#weaponCountResult').hide();
        });
    });
</script>

<?php session()->remove('position'); ?>
<?= $this->endSection() ?>