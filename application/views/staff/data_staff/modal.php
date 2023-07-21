<!-- Modal Tambah Data Staff -->
<div class="modal" id="modal_tambah_data_staff" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaltambah"></div>
   </div>
 </div>
</div>

<!-- Modal Edit Data Staff -->
<div class="modal" id="modal_edit_data_staff" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div id="isimodaledit"></div>
   </div>
 </div>
</div>

<script type="text/javascript">
   /*Modal Tambah Data Staff*/
  function modal_tambah_data_staff() {
    $.ajax({
      url: "<?= site_url('data_staff/modal_tambah_data_staff') ?>",
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
        $('#modal_tambah_data_staff').modal('show');
        $('#isimodaltambah').html(data);
      }
    });
  }

  /*Modal Edit Data Staff*/
  $('#table_data_staff').on('click', '.edit', function(e) {
    e.preventDefault();

    var id_staff = $(this).data('id_staff');

    $.ajax({
      url: "<?= site_url('data_staff/modal_edit_data_staff')?>",
      method: "POST",
      data: {id_staff: id_staff},

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
        $('#modal_edit_data_staff').modal('show');
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

  /*Delete Data Staff*/
  function delete_data(id)
  {
    Swal.fire({
      title: 'Delete',
      text: "Hapus Data Staff?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= site_url('data_staff/delete_data_staff') ?>",
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
              reload_table_data_staff();
            }
          }
        })
      }
    })
  }

</script>