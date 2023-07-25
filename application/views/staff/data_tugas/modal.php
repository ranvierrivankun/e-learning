<!-- Modal Tambah Data Tugas -->
<div class="modal" id="modal_tambah_data_tugas" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tugas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodaltambah"></div>
      </div>
   </div>
</div>

<!-- Modal Edit Data Tugas -->
<div class="modal" id="modal_edit_data_tugas" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Tugas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodaledit"></div>
      </div>
   </div>
</div>

<script type="text/javascript">
    /*Modal Tambah Data Tugas*/
   function modal_tambah_data_tugas() {

      var id_jadpel = $('#id_jadpel').val();

      $.ajax({
         url: "<?= site_url('Jadwal_mengajar/modal_tambah_data_tugas') ?>",
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
         success: function(data) {
            Swal.close();
            $('#modal_tambah_data_tugas').modal('show');
            $('#isimodaltambah').html(data);
         }
      });
   }

   /*Modal Edit Data Tugas*/
   $('#table_data_tugas').on('click', '.edit', function(e) {
      e.preventDefault();

      var id_tugas = $(this).data('id_tugas');

      $.ajax({
         url: "<?= site_url('Jadwal_mengajar/modal_edit_data_tugas')?>",
         method: "POST",
         data: {id_tugas: id_tugas},

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
            $('#modal_edit_data_tugas').modal('show');
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

   /*Delete Data Tugas*/
   function delete_data(id)
   {
      Swal.fire({
         title: 'Delete',
         text: "Menghapus Data Tugas akan menghapus juga data upload tugas siswa. Anda yakin?",
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         confirmButtonText: 'Hapus',
         cancelButtonText: 'Batal'
      }).then((result) => {
         if (result.value) {
            $.ajax({
               type: "post",
               url: "<?= site_url('Jadwal_mengajar/delete_data_tugas') ?>",
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
                     reload_table_data_tugas();
                  }
               }
            })
         }else if (result.dismiss === Swal.DismissReason.cancel){
          Swal.fire({
           confirmButtonColor: '#6e7881',
           icon: 'info',
           text: `Anda Membatalkan`,
           timer: 1500
        })
       }
    })
   }
</script>