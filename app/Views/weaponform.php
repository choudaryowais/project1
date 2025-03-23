<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="background-image">
    <div class="weapon-form-container">
        <h2>Weapon Registration</h2>
        <!-- Form for weapon data -->
        <form action="<?= base_url('WeaponController/SaveWeaponForm'); ?>" method="POST">
            <div class="weapon-form-group">
                <label for="weapon_name">Weapon Name</label>
                <select id="weapon_name" name="weapon_name" required onchange="updateWeaponType()">
                    <option value="SMG(AK-47)">SMG (AK-47)</option>
                    <option value="G3">G3</option>
                    <option value="MP-5">MP-5</option>
                    <option value="Beretta">Beretta</option>
                    <option value="Glock">Glock</option>
                    <option value="Revolver">Revolver</option>
                </select>
            </div>

            <!-- Hidden input for weapon type -->
            <input type="hidden" id="weapon_type" name="weapon_type" value="">

            <div class="weapon-form-group">
                <label for="weapon_no">Weapon Number</label>
                <input type="text" id="weapon_no" name="weapon_no" placeholder="Enter weapon number" required>
            </div>
            <div class="weapon-form-group">
                <label for="police_station_id">Police Station</label>
                <select id="police_station_id" name="police_station_id" required>
                    <option value="1">Kallar Syedan</option>
                    <option value="2">Muzang</option>
                    <option value="3">Westridge</option>
                    <!-- <option value="4">Police Station 4</option>
                    <option value="5">Police Station 5</option> -->
                </select>

            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>
</div>

<!-- Include the external JavaScript file -->
<script src="<?= base_url('assets/js/weaponform.js'); ?>"></script>

<!-- sweet alert message for account created successfully -->
<?php if(session()->getFlashdata('error')): ?>
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Weapon Not Added',
            showConfirmButton: false,
            timer: 1500,
            text: "<?= session()->getFlashdata('error'); ?>",
        });
    </script>
<?php endif; ?> 

<?php if(session()->getFlashdata('success')): ?>
    <script type="text/javascript">
        Swal.fire({
            icon: 'success',
            title: 'Weapon Added Successfully',
            showConfirmButton: false,
            timer: 2000,
            text: "<?= session()->getFlashdata('success'); ?>",
        });
    </script>
<?php endif; ?> 

<?= $this->endSection(); ?>