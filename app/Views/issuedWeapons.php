<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<div class="container mt-5">


    <h1>Weapons Stats</h1>

    <!-- Employee Details Modal -->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="employeeDetails">
                    <div class="text-center py-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading employee data...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($issuedWeapons) && is_array($issuedWeapons)): ?>
        <table id="myTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Weapon ID</th>
                    <th>Weapon Number</th>
                    <th>Weapon Name</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Bullet Name</th>
                    <th>Bullet Quantity</th>
                    <th>User ID</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($issuedWeapons as $weapon): 
                    $badgeClass = 'bg-danger'; // default red
                    if ($weapon['status'] == 'Available') {
                        $badgeClass = 'bg-success'; // green
                    } elseif ($weapon['status'] == 'Issued') {
                        $badgeClass = 'bg-warning'; // orange
                    }
                ?>
                <tr>
                    <td><?= esc($weapon['weapon_id']) ?></td>
                    <td><?= esc($weapon['weapon_name']) ?></td>
                    <td><?= esc($weapon['weapon_no']) ?></td>
                    <td>
                        <?php if (!empty($weapon['employee_id'])): ?>
                            <a href="#" class="employee-link" data-employee-id="<?= esc($weapon['employee_id']) ?>">
                                <?= esc($weapon['employee_id']) ?>
                            </a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td><?= esc($weapon['employee_name']) ?></td>
                    <td><?= esc($weapon['bullet_name']) ?></td>
                    <td><?= esc($weapon['bullet_quantity']) ?></td>
                    <td><?= esc($weapon['user_id']) ?></td>
                    <td><?= esc($weapon['issue_date']) ?></td>
                    <td><?= esc($weapon['return_date']) ?></td>
                    <td>
                        <span class="badge rounded-pill <?= $badgeClass ?>">
                            <?= esc(ucfirst($weapon['status'])) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No weapon records found.</div>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        responsive: true,
        initComplete: function() {
           this.api().column(0).visible(false); // Hide Return Date
           this.api().column(7).visible(false); // Hide User ID
           this.api().column(9).visible(false); // Hide User ID
        }
    });

    // Handle employee link clicks
    $(document).on('click', '.employee-link', function(e) {
        e.preventDefault();
        var employeeId = $(this).data('employee-id');
        var modal = new bootstrap.Modal(document.getElementById('employeeModal'));
        
        // Show loading state
        $('#employeeDetails').html(`
            <div class="text-center py-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading employee data...</p>
            </div>
        `);
        
        modal.show();
        
        // Fetch employee details via AJAX
        $.ajax({
            url: '<?= base_url('employees/getEmployeeDetails') ?>',
            type: 'GET',
            data: { employee_id: employeeId },
            dataType: 'json',
            success: function(response) {
                console.log("Response:", response); // Debugging
                
                if (response.success && response.data) {
                    var html = `
                        <div class="employee-details">
                            <h6>Employee #${employeeId}</h6>
                            <dl class="row mt-3">
                                <dt class="col-sm-4">Name:</dt>
                                <dd class="col-sm-8">${response.data.name || 'N/A'}</dd>
                                
                                <dt class="col-sm-4">Rank:</dt>
                                <dd class="col-sm-8">${response.data.rank || 'N/A'}</dd>
                                
                                <dt class="col-sm-4">Belt No:</dt>
                                <dd class="col-sm-8">${response.data.beltno || 'N/A'}</dd>
                                
                                <dt class="col-sm-4">CNIC:</dt>
                                <dd class="col-sm-8">${response.data.cnic || 'N/A'}</dd>
                                
                                <dt class="col-sm-4">Phone No:</dt>
                                <dd class="col-sm-8">${response.data.phoneno || 'N/A'}</dd>
                                
                                <dt class="col-sm-4">Police Station:</dt>
                                <dd class="col-sm-8">${response.data.police_station_id || 'N/A'}</dd>
                            </dl>
                        </div>
                    `;
                    $('#employeeDetails').html(html);
                } else {
                    $('#employeeDetails').html(`
                        <div class="alert alert-warning">
                            ${response.message || 'Employee data not available'}
                        </div>
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error, xhr.responseText);
                $('#employeeDetails').html(`
                    <div class="alert alert-danger">
                        <p>Failed to load employee details</p>
                        <p>Status: ${xhr.status}</p>
                        <p>Error: ${error}</p>
                        <small>Check browser console for details</small>
                    </div>
                `);
            }
        });
    });
});
</script>

<?= $this->endSection() ?>