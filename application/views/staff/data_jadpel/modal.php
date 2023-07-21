<!-- Modal Tambah Data Jadpel -->
<div class="modal" id="modal_tambah_data_jadpel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaltambah"></div>
   </div>
 </div>
</div>

<!-- Modal Edit Data Jadpel -->
<div class="modal" id="modal_edit_data_jadpel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Jadwal Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaledit"></div>
   </div>
 </div>
</div>

<script type="text/javascript">
  /*Modal Tambah Data Jadpel*/
  function modal_tambah_data_jadpel() {
    $.ajax({
      url: "<?= site_url('data_jadpel/modal_tambah_data_jadpel') ?>",
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
        $('#modal_tambah_data_jadpel').modal('show');
        $('#isimodaltambah').html(data);
      }
    });
  }

  /*Modal Edit Data Jadpel*/
  $('#table_data_jadpel').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_jadpel = $(this).data('id_jadpel');

    $.ajax({
      url: "<?= site_url('data_jadpel/modal_edit_data_jadpel')?>",
      method: "POST",
      data: {id_jadpel: id_jadpel},

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
        $('#modal_edit_data_jadpel').modal('show');
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

  /*Delete Data Jadpel*/
  function delete_data(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Data Jadwal Pelajaran?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_jadpel/delete_data_jadpel') ?>",
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
              reload_table_data_jadpel();
            }
          }
        })
      }
    })
  }
</script>