<!-- Modal Tambah Data Siswa -->
<div class="modal" id="modal_tambah_data_siswa" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaltambah"></div>
   </div>
 </div>
</div>

<!-- Modal Edit Data Siswa -->
<div class="modal" id="modal_edit_data_siswa" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaledit"></div>
   </div>
 </div>
</div>

<script type="text/javascript">
  /*Modal Tambah Data Siswa*/
  function modal_tambah_data_siswa() {
    $.ajax({
      url: "<?= site_url('data_siswa/modal_tambah_data_siswa') ?>",
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
        $('#modal_tambah_data_siswa').modal('show');
        $('#isimodaltambah').html(data);
      }
    });
  }

  /*Modal Edit Data Siswa*/
  $('#table_data_siswa').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_siswa = $(this).data('id_siswa');

    $.ajax({
      url: "<?= site_url('data_siswa/modal_edit_data_siswa')?>",
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
        $('#modal_edit_data_siswa').modal('show');
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

  /*Delete Data Siswa*/
  function delete_data(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Data Siswa?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_siswa/delete_data_siswa') ?>",
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
              reload_table_data_siswa();
            }
          }
        })
      }
    })
  }
</script>