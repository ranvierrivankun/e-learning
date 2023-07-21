<?php 
$pengaturan = $this->db->select('*')->from('pengaturan')->get()->row();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?></title>

  <!-- Jquery -->
  <script src="<?= base_url(''); ?>/assets/vendor/jquery/jquery-3.7.0.min.js"></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url(''); ?>/assets/images/logo.png" />
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/backend-plugin.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/css/backend.css?v=1.0.0">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/remixicon/fonts/remixicon.css">
  
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">  

  <!-- fontawesome-free-6.4.0-web -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/fontawesome-free-6.4.0-web/css/all.min.css">

  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?= base_url(''); ?>/assets/vendor/sweetalert2/package/dist/sweetalert2.min.css">

  <!-- Select2 Last -->
  <link rel="stylesheet" href="<?= base_url('') ?>/assets/vendor/select2-bootstrap4-theme-master/dist/select2-bootstrap4.min.css">

  <!-- Flatpickr -->
  <link rel="stylesheet" href="<?= base_url('') ?>/assets/vendor/flatpickr/flatpickr.css">

</head>

<body class="">
  <!-- loader Start -->
  <div id="loading">
    <div id="loading-center">
    </div>
  </div>
  <!-- loader END -->

  <!-- Wrapper Start -->
  <div class="wrapper">