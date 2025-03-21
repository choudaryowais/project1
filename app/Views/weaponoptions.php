<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>


<div class=""style="text-align: center;color:white;">
 <h1 class="dashheading" style="color:black"><strong>WELCOME TO AMS DASHBOARD</strong></h1></span>
</div>

       <!-- SECTION 1 -->
     <div class="container my-3">
     <div class="d-flex justify-content-center row text-center">
     <div class="col-12 col-md-6 col-lg-3 mb-3  ">
      <a href="<?=base_url('/WeaponController/issueweapon')?>" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-chart-simple icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">iSSUE WEAPON</h3>
      </a>
     </div>
    
     <div class="col-12 col-md-6 col-lg-3 mb-3">
      <a href="<?=base_url('/WeaponController/showweapon')?>" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-person-rifle icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">VIEW WEAPON</h3>
      </a>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-3">
      <a href="<?=base_url('BulletController/showBullets')?>" class="d-flex flex-column align-items-center justify-content-center p-4  text-white text-decoration-none rounded background-red">
        <i class="fa-solid fa-person-rifle icon_style"></i>
        <h3 class="fw-bold fs-5 text-uppercase mt-2">VIEW BULLETS</h3>
      </a>
    </div>





<?= $this->endSection(); ?>