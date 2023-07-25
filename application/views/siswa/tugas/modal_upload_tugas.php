<?php if($proses > 0) { ?>
    <form method="POST" id="form_upload_update" enctype="multipart/form-data">

        <input type="hidden" name="id_tugas_selesai" value="<?= $upload2->id_tugas_selesai ?>">

        <div class="modal-body">

            <div class="row">
                <div class="col mb-1">

                    <label for="nameLarge" class="form-label">Link Tugas</label>
                    <label class="mt-2 badge badge-success">Tugas Sudah Dikumpulkan</label>

                    <textarea type="text" name="file_tugas_selesai" class="form-control" placeholder="Masukan Link Tugas: https://drive.google.com/file/d/qwertyasdfgzxcvbqazwsxedc123456789/view" required><?= $upload2->file_tugas_selesai ?></textarea>
                </div>
            </div>

            <a class="mt-2 font-weight-bold">Link Tugas disarankan menggunakan Google Drive, Pastikan link tidak di Private.</a>

            <div class="row">
                <div class="col-6 mb-1">
                    <label for="nameLarge" class="form-label">Nilai</label>
                    <input type="number" class="form-control" value="<?= $upload2->nilai_tugas ?>" disabled>
                </div>
                <div class="col-6 mb-1">
                    <label for="nameLarge" class="form-label">Catatan</label>
                    <textarea type="text" class="form-control" disabled><?= $upload2->catatan_tugas ?></textarea>
                </div>
            </div>

        </div>

        <div class="modal-footer">
         <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="saving">Update</button>
     </div>

 </form>
<?php } else { ?>
    <form method="POST" id="form_upload" enctype="multipart/form-data">

        <input type="hidden" name="tugas" value="<?= $upload->id_tugas ?>">

        <div class="modal-body">

            <div class="row">
                <div class="col mb-1">
                    <label for="nameLarge" class="form-label">Link Tugas</label>

                    <textarea type="text" name="file_tugas_selesai" class="form-control" placeholder="Masukan Link Tugas: https://drive.google.com/file/d/qwertyasdfgzxcvbqazwsxedc123456789/view" required></textarea>
                </div>
            </div>

            <a class="mt-2 font-weight-bold">Link Tugas disarankan menggunakan Google Drive, Pastikan link tidak di Private.</a>

        </div>

        <div class="modal-footer">
           <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="saving">Upload</button>
       </div>

   </form>
<?php } ?>



<script type="text/javascript">
     /*Proses Update Upload Tugas*/
    $('#form_upload_update').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Update Tugas?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Update',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_pelajaran/proses_update_upload_tugas')?>",
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
                            text: "Tugas Berhasil Diupdate!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_tugas').DataTable().ajax.reload(null, false);
                            $('#modal_upload_tugas').modal('hide');
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

    /*Proses Upload Tugas*/
    $('#form_upload').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Upload Tugas?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Upload',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_pelajaran/proses_upload_tugas')?>",
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
                            text: "Tugas Berhasil Diupload!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_tugas').DataTable().ajax.reload(null, false);
                            $('#modal_upload_tugas').modal('hide');
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