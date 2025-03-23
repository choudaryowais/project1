<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <h3 class="mb-3 text-center fw-bold">Search Employee</h3>
    <!-- Search Form -->
    <div class="border border-primary p-3">
        <form id="searchForm" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search by Name, Belt No, or CNIC" aria-label="Search">
                <button class="btn btn-primary" type="button" id="searchButton">Search</button>
            </div>
        </form>
    </div>

    <!-- Employee Data Table -->
    <div class="border border-primary p-3 mt-3">
        <table class="table table-striped" id="employeeTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Belt No</th>
                    <th>CNIC</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Employee data will be populated here via AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript to handle search and display results -->
<script>
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchInput = $('#searchInput').val();
            $.ajax({
                url: '<?= base_url('EmployeeController/simplesearch') ?>',
                type: 'POST',
                data: { searchInput: searchInput },
                success: function(response) {
                    var employeeTable = $('#employeeTable tbody');
                    employeeTable.empty();
                    response.data.forEach(function(employee) {
                        var row = '<tr>' +
                            '<td>' + employee.id + '</td>' +
                            '<td>' + employee.name + '</td>' +
                            '<td>' + employee.beltno + '</td>' +  // Ensure this matches the database field
                            '<td>' + employee.cnic + '</td>' +
                            '<td><button class="btn btn-success btn-confirm" data-id="' + employee.id + '">Confirm</button></td>' +
                            '</tr>';
                        employeeTable.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching employee data: ', error);
                }
            });
        });

        // Handle confirm button click
        $('#employeeTable').on('click', '.btn-confirm', function() {
            var employeeId = $(this).data('id');
            console.log('Selected Employee ID: ', employeeId);
            // You can now use the employeeId for further processing
        });
    });
</script>

<?= $this->endSection() ?>