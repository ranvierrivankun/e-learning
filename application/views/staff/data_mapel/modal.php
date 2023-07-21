<!-- Modal Tambah Data Mapel -->
<div class="modal" id="modal_tambah_data_mapel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaltambah"></div>
   </div>
 </div>
</div>

<!-- Modal Edit Data Mapel -->
<div class="modal" id="modal_edit_data_mapel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaledit"></div>
   </div>
 </div>
</div>

<script type="text/javascript">
  /*Modal Tambah Data Mapel*/
  function modal_tambah_data_mapel() {
    $.ajax({
      url: "<?= site_url('data_mapel/modal_tambah_data_mapel') ?>",
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
        $('#modal_tambah_data_mapel').modal('show');
        $('#isimodaltambah').html(data);
      }
    });
  }

  /*Modal Edit Data Mapel*/
  $('#table_data_mapel').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_mapel = $(this).data('id_mapel');

    $.ajax({
      url: "<?= site_url('data_mapel/modal_edit_data_mapel')?>",
      method: "POST",
      data: {id_mapel: id_mapel},

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
        $('#modal_edit_data_mapel').modal('show');
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

  /*Delete Data Mapel*/
  function delete_data(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Data Mata Pelajaran?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_mapel/delete_data_mapel') ?>",
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
              reload_table_data_mapel();
            }
          }
        })
      }
    })
  }
</script>