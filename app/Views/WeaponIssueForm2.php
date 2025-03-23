<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <h3 class="mb-3 text-center fw-bold">Issue Weapon</h3>
    <div class="border border-primary p-3">
    <form action="<?= base_url('weapon-controller/issuing-weapon') ?>" method="POST">
             <input type="hidden" name="weapon_id" value="<?= $weaponDetails['id'] ?>">
            <input type="hidden" name="employee_id" value="<?= $employeeDetails['id'] ?>">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">

            <!-- Employee Details -->
            <div class="mb-3">
                <h6 class="mb-2 fw-bold">Employee Details</h6>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="name" class="form-label small">Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="<?= $employeeDetails['name'] ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="Belt_no" class="form-label small">Belt No</label>
                            <input type="text" class="form-control form-control-sm" id="Belt_no" name="Belt_no" value="<?= $employeeDetails['beltno'] ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weapon Details -->
            <div class="mb-3">
                <h6 class="mb-2 fw-bold">Weapon Details</h6>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="weapon_name" class="form-label small">Weapon Name</label>
                            <input type="text" class="form-control form-control-sm" id="weapon_name" name="weapon_name" value="<?= $weaponDetails['name'] ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="weapon_no" class="form-label small">Weapon No</label>
                            <input type="text" class="form-control form-control-sm" id="weapon_no" name="weapon_no" value="<?= $weaponDetails['weaponno'] ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bullet Details -->
            <div class="mb-3">
                <h6 class="mb-2 fw-bold">Bullet Details</h6>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="bullets_name" class="form-label small">Bullets Name</label>
                            <select class="form-select form-select-sm" id="bullets_name" name="bullets_name" required>
                            <option value="9mm">9mm</option>
                            <option value="7.62x39mm">7.62x39mm</option>
                            <option value="7.62x51mm">7.62x51mm</option>
                            <option value=".22CB">.22CB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="no_of_bullets" class="form-label small">No of Bullets</label>
                            <input type="number" class="form-control form-control-sm" id="no_of_bullets" name="no_of_bullets" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Issue Date -->
            <div class="mb-3">
                <h6 class="mb-2 fw-bold">Issue Date</h6>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="issue_date" class="form-label small">Issue Date</label>
                            <input type="date" class="form-control form-control-sm" id="issue_date" name="issue_date" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary btn-sm">Issue Weapon</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>