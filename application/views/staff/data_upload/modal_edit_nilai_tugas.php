    <form method="POST" id="form_edit" enctype="multipart/form-data">

        <input type="hidden" name="id_tugas_selesai" value="<?= $nilai->id_tugas_selesai ?>">

        <div class="modal-body">

            <div class="row">
                <div class="col mb-1">

                    <label for="nameLarge" class="form-label">Link Tugas</label>
                    <textarea type="text" class="form-control" placeholder="Masukan Link Tugas: https://drive.google.com/file/d/qwertyasdfgzxcvbqazwsxedc123456789/view" required disabled><?= $nilai->file_tugas_selesai ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-1">
                    <label for="nameLarge" class="form-label">Nilai (1-100)</label>
                    <input type="number" name="nilai_tugas" class="form-control" value="<?= $nilai->nilai_tugas ?>" required>
                </div>
                <div class="col-6 mb-1">
                    <label for="nameLarge" class="form-label">Catatan</label>
                    <textarea type="text" name="catatan_tugas" class="form-control"><?= $nilai->catatan_tugas ?></textarea>
                </div>
            </div>

        </div>

        <div class="modal-footer">
           <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="saving">Update</button>
       </div>

   </form>

   <script type="text/javascript">
     /*Proses Edit Nilai Tugas*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Update Nilai Tugas?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Update',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_mengajar/proses_edit_nilai_tugas')?>",
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
                            text: "Nilai Tugas Berhasil Diupdate!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_upload').DataTable().ajax.reload(null, false);
                            $('#modal_edit_nilai_tugas').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                           /*$('#modal_edit_data_tugas').modal('hide');*/
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
            }else if (result.dismiss === Swal.DismissReason.cancel){
                Swal.fire({
                    confirmButtonColor: '#6e7881',
                    icon: 'info',
                    text: `Anda Membatalkan`,
                    timer: 1500
                })
            }
        })
    });
</script>