<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <h3 class="mb-3 text-center fw-bold">Search Employee</h3>
    <!-- Search Form -->
    <div class="border border-primary p-3">
        <form id="searchForm" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search by Name, Belt No, or CNIC" aria-label="Search">
                <button class="btn btn-primary" type="submit" id="searchButton">
                    <span id="searchButtonText">Search</span>
                    <span id="searchButtonSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
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
        // Handle form submission (both button click and Enter key)
        $('#searchForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            performSearch();
        });

        // Handle search button click
        $('#searchButton').click(function() {
            performSearch();
        });

        // Function to perform the search
        function performSearch() {
            var searchInput = $('#searchInput').val();
            if (!searchInput) {
                alert('Please enter a search term.');
                return;
            }

            // Show loading spinner
            $('#searchButtonText').text('Searching...');
            $('#searchButtonSpinner').removeClass('d-none');

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
                    alert('An error occurred while fetching data. Please try again.');
                },
                complete: function() {
                    // Hide loading spinner
                    $('#searchButtonText').text('Search');
                    $('#searchButtonSpinner').addClass('d-none');
                }
            });
        }

       // Handle confirm button click
$('#employeeTable').on('click', '.btn-confirm', function() {
    var employeeId = $(this).data('id');
    var weaponId = <?= $weapon_id ?>; // Pass the weapon_id from the controller to the view

    // Redirect to the final form with employee_id and weapon_id
    window.location.href = "<?= base_url('weapon-controller/issue-weapon-form') ?>?employee_id=" + employeeId + "&weapon_id=" + weaponId;
});
    });
</script>

<?= $this->endSection() ?>