<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
</head>
<body>
    <div class="background-image">
        <div class="employee-form-container">
            <h2>Employee Form</h2>
            <form action="<?= base_url('EmployeeController/SaveEmployeeForm'); ?>" method="POST">
                <!-- Name Field -->
                <div class="employee-form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <!-- CNIC Field -->
                <div class="employee-form-group">
                    <label for="cnic">CNIC (15 characters):</label>
                    <input type="text" id="cnic" name="cnic" placeholder="Enter CNIC" maxlength="15" required>
                </div>

                <!-- Belt No Field -->
                <div class="employee-form-group">
                    <label for="beltNo">Belt No:</label>
                    <input type="text" id="beltNo" name="beltNo" placeholder="Enter Belt No" required>
                </div>

                <!-- Police Station Field (Dropdown) -->
                <div class="employee-form-group">
                    <label for="police_station_id">Police Station:</label>
                    <select id="police_station_id" name="police_station_id" required>
                        <option value="">Select Police Station</option>
                        <option value="1">Kallar Syedan</option>
                        <option value="2">Muzang</option>
                        <option value="3">Westridge</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>