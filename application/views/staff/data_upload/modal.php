<!-- Modal Nilai Tugas -->
<div class="modal" id="modal_nilai_tugas" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nilai Tugas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodalnilai"></div>
      </div>
   </div>
</div>

<!-- Modal Edit Nilai Tugas -->
<div class="modal" id="modal_edit_nilai_tugas" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nilai Tugas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodaledit"></div>
      </div>
   </div>
</div>

<script type="text/javascript">
   /*Modal Nilai Tugas*/
   $('#table_data_upload').on('click', '.nilai', function(e) {
      e.preventDefault();

      var id_tugas_selesai = $(this).data('id_tugas_selesai');

      $.ajax({
         url: "<?= site_url('Jadwal_mengajar/modal_nilai_tugas')?>",
         method: "POST",
         data: {id_tugas_selesai: id_tugas_selesai},

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
            $('#modal_nilai_tugas').modal('show');
            $('#isimodalnilai').html(data);
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

   /*Modal Edit Nilai Tugas*/
   $('#table_data_upload').on('click', '.edit', function(e) {
      e.preventDefault();

      var id_tugas_selesai = $(this).data('id_tugas_selesai');

      $.ajax({
         url: "<?= site_url('Jadwal_mengajar/modal_edit_nilai_tugas')?>",
         method: "POST",
         data: {id_tugas_selesai: id_tugas_selesai},

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
            $('#modal_edit_nilai_tugas').modal('show');
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
</script>