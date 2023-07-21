<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?></title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url(''); ?>/assets/images/logo.png" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/backend-plugin.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/backend.css?v=1.0.0">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/remixicon/fonts/remixicon.css">

  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">  
</head>

<body class=" ">
  <!-- loader Start -->
  <div id="loading">
     <div id="loading-center">
     </div>
  </div>
  <!-- loader END -->

  <div class="wrapper">
   <section class="login-content">
      <div class="container">
         <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
               <div class="card auth-card">
                  <div class="card-body p-0">
                     <div class="d-flex align-items-center auth-content">
                        <div class="col-lg-6 bg-primary content-left">
                           <div class="p-3">
                              <h2 class="mb-2 text-white">Siswa <?= $nama_sekolah ?></h2>
                              <p>Login untuk masuk kedalam sistem.</p>

                              <?= $this->session->flashdata('pesan'); ?>
                              <?= form_error('nisn', '<small class="valid text-danger">', '</small>'); ?>
                              <p>
                                 <?= form_error('password', '<small class="valid text-danger">', '</small>'); ?>

                                 <form method="post" action="<?= base_url('auth'); ?>">
                                    <div class="row">

                                     <div class="col-lg-12">
                                       <div class="floating-label form-group">
                                          <input class="floating-input form-control" type="number" name="nisn" placeholder=" ">
                                          <label>NISN</label>
                                       </div>
                                    </div>
                                    

                                    <div class="col-lg-12">
                                       <div class="floating-label form-group">
                                          <input class="floating-input form-control" type="password" name="password" placeholder=" ">
                                          <label>Password</label>
                                       </div>
                                    </div>
                                    
                                 </div>

                                 <button type="submit" class="btn btn-white">Sign In</button>
  
                              </form>
                           </div>
                        </div>
                        <div class="col-lg-6 content-right">
                           <img src="<?= base_url(''); ?>/assets/images/login/01.png" class="img-fluid image-right" alt="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<!-- Backend Bundle JavaScript -->
<script src="<?= base_url(''); ?>/assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="<?= base_url(''); ?>/assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="<?= base_url(''); ?>/assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="<?= base_url(''); ?>/assets/js/chart-custom.js"></script>
<!-- Chart Custom JavaScript -->
<script async src="<?= base_url(''); ?>/assets/js/slider.js"></script>

<!-- app JavaScript -->
<script src="<?= base_url(''); ?>/assets/js/app.js"></script>

<script src="<?= base_url(''); ?>/assets/vendor/moment.min.js"></script>
</body>
</html>

<!-- REMOVE ALERT -->
<script>
   window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
      });
   }, 2000);
</script>