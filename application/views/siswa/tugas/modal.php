<!-- Modal Upload Tugas -->
<div class="modal" id="modal_upload_tugas" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Tugas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div id="isimodalupload"></div>
      </div>
   </div>
</div>

<script type="text/javascript">
    /*Modal Upload Tugas*/
   $('#table_data_tugas').on('click', '.edit', function(e) {
      e.preventDefault();

      var id_tugas = $(this).data('id_tugas');

      $.ajax({
         url: "<?= site_url('Jadwal_pelajaran/modal_upload_tugas')?>",
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
            $('#modal_upload_tugas').modal('show');
            $('#isimodalupload').html(data);
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