</div>

<!-- Wrapper End-->
<?php 
$pengaturan = $this->db->select('*')->from('pengaturan')->get()->row();
?>

<footer class="iq-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 text-left">
        <span class="mr-1">©<script>document.write(new Date().getFullYear())</script> Aplikasi E-Learning <?= $pengaturan->nama_sekolah?></span>
      </div>
    </div>
  </div>
</footer>

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

<!-- fontawesome-free-6.4.0-web -->
<script src="<?= base_url(''); ?>/assets/vendor/fontawesome-free-6.4.0-web/js/fontawesome.min.js"></script>

<!-- sweetalert2 -->
<script src="<?= base_url(''); ?>/assets/vendor/sweetalert2/package/dist/sweetalert2.min.js"></script>

<!-- Select2 Last -->
<script src="<?= base_url('') ?>/assets/vendor/select2_last/dist/js/select2.full.min.js"></script>

</body>
</html>