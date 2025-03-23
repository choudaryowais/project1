<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<div class="background-image">

<div class="bullet-form-container">
    <h2>Bullet Registration</h2>
    <!-- Form for bullet data -->
    <form action="<?= base_url('BulletsController/insert'); ?>" method="POST">
        <div class="bullet-form-group">
            <label for="name">Bullet Name</label>
            <select id="name" name="name" required>
                <option value="9mm">9mm</option>
                <option value="7.62x39mm">7.62x39mm</option>
                <option value="7.62x51mm">7.62x51mm</option>
                <option value=".22CB">.22CB</option>
            </select>
        </div>

        <div class=bullet-form-group>
            <label for="quantity">Total Quantity</label>
            <input type="number" id="quantity" name="quantity" placeholder="Enter total quantity" required>
        </div>

        <div class=bullet-form-group>
        <label for="police_station_id">Police Station</label>
        <select id="police_station_id" name="police_station_id" required>
                    <option value="1">Kallar Syedan</option>
                    <option value="2">Muzang</option>
                    <option value="3">Westridge</option>
       </select>
                </div>

        <button type="submit" class="btn-submit">Submit</button>
    </form>
</div>
</div>
<script src="<?= base_url('assets/js/weaponform.js'); ?>"></script>

<!-- sweet alert message for account created successfully -->
<?php if(session()->getFlashdata('error')): ?>
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Bullets Not Added',
            showConfirmButton: false,
            timer: 2000,
            text: "<?= session()->getFlashdata('error'); ?>",
        });
    </script>
<?php endif; ?> 

<?php if(session()->getFlashdata('success')): ?>
    <script type="text/javascript">
        Swal.fire({
            icon: 'success',
            title: 'Bullets Added Successfully',
            showConfirmButton: false,
            timer: 2000,
            text: "<?= session()->getFlashdata('success'); ?>",
        });
    </script>
<?php endif; ?> 

<?= $this->endSection(); ?>