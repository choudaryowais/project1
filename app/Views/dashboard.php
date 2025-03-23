<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<body>
<div class=""style="text-align: center;color:white;">
                                    <h1 class="dashheading" style="color:black"><strong>WELCOME TO AMS DASHBOARD</strong></h1>
            
                                  </span>
                                </div>
       <!-- SECTION 1 -->
<div class="container my-3">
  <div class="row text-center">
    <div class="col-12 col-md-6 col-lg-3 mb-3 ">
      <a href="/" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-chart-simple icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">Status</h3>
      </a>
    </div>
    
    <div class="col-12 col-md-6 col-lg-3 mb-3">
      <a href="<?=base_url('/WeaponController/weaponoptions')?>" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-person-rifle icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">Weapons</h3>
      </a>
    </div>
    
    <div class="col-12 col-md-6 col-lg-3 mb-3">
      <a href="/" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-gears icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">Manage Weapons</h3>
      </a>
    </div>
    
    <div class="col-12 col-md-6 col-lg-3 mb-3">
      <a href="/" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-users-gear icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">Manage Users</h3>
      </a>
    </div>
  </div>



      <!-- stats cards -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<div class="row mt-5">
    <div class="col-md-3 col-6 mb-4">
        <div class="text-center">
            <i class="fa-solid fa-person-military-rifle fs-1 text-secondary mb-2"></i>
            <h2 class="fw-bold"><?= $totalWeapons; ?></h2>
            <p class="text-muted fw-bold">Total Weapons</p>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="text-center">
            <i class="fa-solid fa-circle-check fs-1 text-secondary mb-2"></i>
            <h2 class="fw-bold"><?= $issuedWeapons?></h2>
            <p class="text-muted fw-bold">Issued</p>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="text-center">
            <i class="fa-solid fa-circle-check  fs-1 text-secondary mb-2"></i>
            <h2 class="fw-bold"><?= $availableWeapons?></h2>
            <p class="text-muted fw-bold">Available</p>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="text-center">
            <i class="bi bi-globe fs-1 text-secondary mb-2"></i>
            <h2 class="fw-bold">20+</h2>
            <p class="text-muted fw-bold">Countries</p>
        </div>
    </div>
</div>
</div>

<!-- end of stats cards -->
       
     




<?= $this->endSection(); ?>