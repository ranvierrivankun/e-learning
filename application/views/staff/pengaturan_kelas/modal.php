<!-- Modal Tambah Data Kejuruan -->
<div class="modal" id="modal_tambah_data_kejuruan" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kejuruan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaltambah"></div>
   </div>
 </div>
</div>

<!-- Modal Edit Data Kejuruan -->
<div class="modal" id="modal_edit_data_kejuruan" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kejuruan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaledit"></div>
   </div>
 </div>
</div>

<!-- Modal Tambah Data Kelas -->
<div class="modal" id="modal_tambah_data_kelas" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaltambah2"></div>
   </div>
 </div>
</div>

<!-- Modal Edit Data Kelas -->
<div class="modal" id="modal_edit_data_kelas" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaledit2"></div>
   </div>
 </div>
</div>

<script type="text/javascript">
  /*Modal Tambah Data Kejuruan*/
  function modal_tambah_data_kejuruan() {
    $.ajax({
      url: "<?= site_url('pengaturan_kelas/modal_tambah_data_kejuruan') ?>",
      beforeSend: ()=> {
        Swal.fire({
          title : 'Menunggu',
          html : 'Memproses data',
          didOpen: () => {
            Swal.showLoading()
          }
        })
      },
      success: function(data) {
        Swal.close();
        $('#modal_tambah_data_kejuruan').modal('show');
        $('#isimodaltambah').html(data);
      }
    });
  }

/*Modal Edit Data Kejuruan*/
  $('#table_data_kejuruan').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_kejuruan = $(this).data('id_kejuruan');

    $.ajax({
      url: "<?= site_url('pengaturan_kelas/modal_edit_data_kejuruan')?>",
      method: "POST",
      data: {id_kejuruan: id_kejuruan},

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
        $('#modal_edit_data_kejuruan').modal('show');
        $('#isimodaledit').html(data);
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

/*Delete Data Kejuruan*/
  function delete_data(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Data Kejuruan?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('pengaturan_kelas/delete_data_kejuruan') ?>",
          data : {
            id: id,
          },
          dataType: "json",
          success: function(response) {
            if(response.sukses){
              Swal.fire({
                icon: 'success',
                confirmButtonColor: '#697a8d',
                title: 'Berhasil',
                timer: 1000,
                text: response.sukses
              });
              reload_table_data_kejuruan();
              reload_table_data_kelas();
            }
          }
        })
      }
    })
  }

    /*Modal Tambah Data Kelas*/
  function modal_tambah_data_kelas() {
    $.ajax({
      url: "<?= site_url('pengaturan_kelas/modal_tambah_data_kelas') ?>",
      beforeSend: ()=> {
        Swal.fire({
          title : 'Menunggu',
          html : 'Memproses data',
          didOpen: () => {
            Swal.showLoading()
          }
        })
      },
      success: function(data) {
        Swal.close();
        $('#modal_tambah_data_kelas').modal('show');
        $('#isimodaltambah2').html(data);
      }
    });
  }

  /*Modal Edit Data Kelas*/
  $('#table_data_kelas').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_kelas = $(this).data('id_kelas');

    $.ajax({
      url: "<?= site_url('pengaturan_kelas/modal_edit_data_kelas')?>",
      method: "POST",
      data: {id_kelas: id_kelas},

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
        $('#modal_edit_data_kelas').modal('show');
        $('#isimodaledit2').html(data);
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

  /*Delete Data Kelas*/
  function delete_data2(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Data Kelas?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('pengaturan_kelas/delete_data_kelas') ?>",
          data : {
            id: id,
          },
          dataType: "json",
          success: function(response) {
            if(response.sukses){
              Swal.fire({
                icon: 'success',
                confirmButtonColor: '#697a8d',
                title: 'Berhasil',
                timer: 1000,
                text: response.sukses
              });
              reload_table_data_kelas();
            }
          }
        })
      }
    })
  }
</script>