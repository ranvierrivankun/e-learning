<?php
$id_kelas = userdata('kelas');
$query = $this->db->select('*')->from('data_kelas')->join('data_kejuruan','id_kejuruan=kejuruan')->where('id_kelas',$id_kelas)->get()->row();
?>

<div class="iq-top-navbar">
  <div class="iq-navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
      <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
        <i class="ri-menu-line wrapper-menu"></i>
        <a href="<?= base_url('dashboard'); ?>" class="header-logo">
          <h5 class="logo-title text-uppercase">E-Learning</h5>

        </a>
      </div>
      <div class="navbar-breadcrumb">
        <h5>E-LEARNING <a class="font-italic"><?= $query->nama_kelas ?> - <?= $query->nama_kejuruan ?></a></h5>
      </div>
      <div class="d-flex align-items-center">

        <ul class="navbar-nav ml-auto navbar-list align-items-center" id="navbar_menu">

          <li class="nav-item nav-icon dropdown">

            <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <img src="<?= base_url(''); ?>/file/foto/<?= userdata('foto') ?>" class="img-fluid rounded-circle" alt="user">

              <div class="caption ml-3">
                <h6 class="mb-0 line-height"><?= userdata('nama_siswa') ?><i class="las la-angle-down ml-2"></i></h6>
              </div>
            </a>      

            <div class="dropdown-menu dropdown-menu-right border-none">
              <a class="dropdown-item d-flex" href="<?= base_url('profile'); ?>"><i class="fa-solid fa-user mt-1 mr-2"></i>Profile Saya</a>

              <a class="dropdown-item d-flex ganti_password" data-id_siswa="<?= userdata('id_siswa'); ?>" href="#"><i class="fa-solid fa-key mt-1 mr-2"></i>Ganti Password</a>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item d-flex" href="<?= base_url('auth/logout'); ?>"><i class="fa-solid fa-arrow-right-from-bracket mt-1 mr-2"></i>Keluar</a>
            </div>                      
          </li>

        </ul>

      </div>
    </nav>
  </div>
</div>

<!-- Modal Ganti Password -->
<div class="modal" id="modal_ganti_password" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodal"></div>
   </div>
 </div>
</div>

<!-- Modal Ganti Password -->
<script type="text/javascript">
  $('#navbar_menu').on('click', '.ganti_password', function(e) {
    e.preventDefault();

    var id_siswa = $(this).data('id_siswa');

    $.ajax({
      url: "<?= site_url('dashboard/modal_ganti_password')?>",
      method: "POST",
      data: {id_siswa: id_siswa},

      beforeSend: ()=> {
        Swal.fire({
          title : 'Menunggu',
          html : 'Memproses data',
          didOpen: () => {
            Swal.showLoading()
          }
        })
      },

      success: (data)=> {
        Swal.close();
        $('#modal_ganti_password').modal('show');
        $('#isimodal').html(data);
      },

      error: (req, status, error)=> {
        Swal.fire({
          icon: 'error',
          title: `Gagal ${req.status}`,
          text: `Silahkan Coba Lagi`,
          timer: 1500
        })
      },
    })

  })
</script>