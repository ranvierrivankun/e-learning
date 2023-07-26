<!-- Modal Tambah Data Absen -->
<div class="modal" id="modal_tambah_data_absen" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Buka Absen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodaltambah"></div>
      </div>
   </div>
</div>

<!-- Modal Edit Data Absen -->
<div class="modal" id="modal_edit_data_absen" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Absen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodaledit"></div>
      </div>
   </div>
</div>

<script type="text/javascript">
    /*Modal Tambah Data Absen*/
   function modal_tambah_data_absen() {

      var id_jadpel = $('#id_jadpel').val();

      $.ajax({
         url: "<?= site_url('Jadwal_mengajar/modal_tambah_data_absen') ?>",
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
            $('#modal_tambah_data_absen').modal('show');
            $('#isimodaltambah').html(data);
         }
      });
   }

   /*Modal Edit Data Absen*/
   $('#table_data_absen').on('click', '.edit', function(e) {
      e.preventDefault();

      var id_absen = $(this).data('id_absen');

      $.ajax({
         url: "<?= site_url('Jadwal_mengajar/modal_edit_data_absen')?>",
         method: "POST",
         data: {id_absen: id_absen},

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
            $('#modal_edit_data_absen').modal('show');
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

    /*Delete Data Absen*/
   function delete_data(id)
   {
      Swal.fire({
         title: 'Delete',
         text: "Menghapus Data Absen akan menghapus juga data absen murid. Anda yakin?",
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         confirmButtonText: 'Hapus',
         cancelButtonText: 'Batal'
      }).then((result) => {
         if (result.value) {
            $.ajax({
               type: "post",
               url: "<?= site_url('Jadwal_mengajar/delete_data_absen') ?>",
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
                        timer: 3000,
                        text: response.sukses
                     });
                     /*reload_table_data_absen();*/
                     location.reload()
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

   /*Tutup Data Absen*/
   function tutup_data_absen()
   {
      var id_jadpel = $('#id_jadpel').val();
      var id_mapel = $('#id_mapel').val();
      var id_kelas = $('#id_kelas').val();

      Swal.fire({
         title: 'Tutup Absen',
         text: "Anda Yakin menutup Absen?",
         icon: 'question',
         showCancelButton: true,
         confirmButtonColor: '#cc0000',
         confirmButtonText: 'Tutup',
         cancelButtonText: 'Batal'
      }).then((result) => {
         if (result.value) {
            $.ajax({
               method: "post",
               url: "<?= site_url('Jadwal_mengajar/tutup_data_absen') ?>",
               data : {
                  id_jadpel: id_jadpel,
                  id_mapel: id_mapel,
                  id_kelas: id_kelas,
               },
               dataType: "json",
               success: function(response) {
                  if(response.sukses){
                     Swal.fire({
                        icon: 'success',
                        confirmButtonColor: '#697a8d',
                        title: 'Berhasil',
                        timer: 3000,
                        text: response.sukses
                     });
                     /*reload_table_data_absen();*/
                     location.reload()
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