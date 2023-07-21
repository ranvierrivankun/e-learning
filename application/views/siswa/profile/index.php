<div class="content-page">
  <div class="container-fluid">
   <div class="row">
    <div class="col-lg-12">
     <div class="card car-transparent">
      <div class="card-body p-0">
       <div class="profile-image position-relative">
        <img src="<?= base_url(''); ?>/assets/images/page-img/profile.jpg" class="img-fluid rounded w-100" alt="profile-image">
      </div>
    </div>
  </div>
</div>
</div>
<div class="row m-sm-0 px-3">            
  <div class="col-lg-4 card-profile">
   <div class="card card-block card-stretch card-height">
    <div class="card-body">
     <div class="d-flex align-items-center mb-3">
      <div class="profile-img position-relative">
       <img src="<?= base_url(''); ?>/file/foto/<?= userdata('foto') ?>" class="img-fluid rounded avatar-110" alt="profile-image">
     </div>
     <div class="ml-3">
       <h4 class="mb-1"><?= userdata('nama_siswa'); ?></h4>

       <?php if( userdata('jk_siswa') == 'Pria' ) { ?>
        <p class="mb-2">Siswa</p>
      <?php } else { ?>
        <p class="mb-2">Siswi</p>
      <?php } ?>


      <?php if( userdata('status_siswa') == 'aktif' ) { ?>
        <p class="btn btn-success font-size-14">Status Aktif</p>
      <?php } else { ?>
        <p class="btn btn-danger font-size-14">Status Nonaktif</p>
      <?php } ?>


    </div>
  </div>
  <p>
    <?= $getDataSiswa->motto_siswa ?>
  </p>
  <ul class="list-inline p-0 m-0">
   <li class="mb-2">
     <div class="d-flex align-items-center">
      <i class="fa-solid fa-address-card mr-3"></i>
      <p class="mb-0"><?= $getDataSiswa->nisn ?></p>   
    </div>
  </li>
  <li class="mb-2">
   <div class="d-flex align-items-center">
    <i class="fa-solid fa-phone mr-3"></i>
    <p class="mb-0"><?= $getDataSiswa->notelp_siswa ?></p>   
  </div>
</li>
<li>
 <div class="d-flex align-items-center">
  <i class="fa-solid fa-envelope mr-3"></i>
  <p class="mb-0"><?= $getDataSiswa->email_siswa ?></p>   
</div>
</li>
</ul>
</div>
</div>
</div>

<div class="mt-1 col-lg-8 card-profile">
 <div class="card card-block card-stretch card-height">
  <div class="card-body">
   <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active show" data-toggle="pill" href="#edit" role="tab" aria-selected="false">Edit Profile</a>
    </li>
  </ul>

  <div class="profile-content tab-content">

    <form method="POST" id="form_edit_profile" enctype="multipart/form-data">

      <input type="hidden" name="id_siswa" value="<?= $getDataSiswa->id_siswa ?>">

      <div id="edit" class="tab-pane fade active show">
        <div class="row">
          <div class="col-lg-6">
           <ul class="list-inline p-0 m-0">

            <li class="mb-4">
              <div class="form-group">
                <label for="exampleInputText1">NISN</label>
                <input type="text" class="form-control" placeholder="<?= $getDataSiswa->nisn ?>" readonly>
              </div>
            </li>

            <li class="mb-4">
              <div class="form-group">
                <label for="exampleInputText1">Nama</label>
                <input type="text" class="form-control" placeholder="<?= $getDataSiswa->nama_siswa ?>" readonly>
              </div>
            </li>

            <li class="mb-4">
             <div class="form-group">
              <label for="exampleInputText1">Motto</label>
              <textarea rows="4" type="text" class="form-control" name="motto_siswa" placeholder="Masukan Motto" required><?= $getDataSiswa->motto_siswa ?></textarea>
            </div>
          </li>

        </ul>
      </div>
      <div class="col-lg-6">
       <ul class="list-inline p-0 m-0">

        <li class="mb-4">
         <div class="form-group">
          <label for="exampleInputText1">Nomor Telepon</label>
          <input type="number" class="form-control" name="notelp_siswa" value="<?= $getDataSiswa->notelp_siswa ?>" placeholder="Masukan Nomor Telepon" required>
        </div>
      </li>

      <li class="mb-4">
       <div class="form-group">
        <label for="exampleInputText1">Email</label>
          <input type="email" class="form-control" name="email_siswa" value="" placeholder="<?= $getDataSiswa->email_siswa ?>">
        </div>
      </li>

      <li class="mb-4">
       <div class="form-group">
        <label for="exampleInputText1">Ganti Foto <strong>Maks 5MB (jpg,jpeg,png)</strong></label>
        <input type="file" class="form-control-file" name="foto">
      </div>
    </li>

  </ul>
</div>
</div>
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-primary" id="saving">Edit Profile</button>
</div>

</form>


</div>

</div>
</div>
</div>

</div>
</div>
</div>

<!-- Proses Edit Profile -->
<script type="text/javascript">
  $('#form_edit_profile').on('submit', function(e) {
    e.preventDefault();

    Swal.fire({
      title: `Konfirmasi`,
      text: `Perbaharui Profile?`,
      icon: 'question',
      showCancelButton : true,
      confirmButtonText : 'Perbaharui',
      confirmButtonColor : '#696cff',
      cancelButtonText : 'Tidak',
      reverseButtons : true
    }).then((result)=> {
      if(result.value) {
        $.ajax({
          url: "<?= site_url('profile/proses_edit_profile') ?>",
          method: "POST",
          data: new FormData(this),
          processData: false,
          contentType: false,
          async: true,

          beforeSend: function(){
            Swal.fire({
              title: "Menyimpan",
              text: "Silahkan Tunggu, Proses Memakan Waktu",
              didOpen: () => {
                Swal.showLoading()
              }
            });
          },

          success: function(data){

            if(data.status == true) {
              Swal.fire({
                confirmButtonColor: '#696cff',
                icon: "success",
                title: "Berhasil",
                text: "Profile Diperbaharui!",
                timer: 1500,
              }).then((e)=> {
                window.location.reload();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Gagal",
                text: data.keterangan,
                timer: 3000,
              }).then((e)=> {
              });
            }

          },

          error: (req, status, error)=> {
            Swal.fire({
              icon: 'error',
              title: `Gagal ${req.status}`,
              text: `Silahkan Coba Lagi`,
              timer: 1500
            })
          },

        });
        return false;
      }
    })
  })
</script>