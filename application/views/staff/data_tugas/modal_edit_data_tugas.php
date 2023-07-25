<form method="POST" id="form_edit" enctype="multipart/form-data">

    <input type="hidden" name="id_tugas" value="<?= $edit->id_tugas ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Judul Tugas</label>
                <input type="text" name="judul_tugas" class="form-control" placeholder="Masukan Judul Tugas" value="<?= $edit->judul_tugas ?>" required>
            </div>

            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Deskripsi Tugas</label>
                <textarea type="text" name="des_tugas" class="form-control" placeholder="Masukan Deskripsi Tugas" required><?= $edit->des_tugas ?></textarea>
            </div>
        </div>

        <div class="row">
           <div class="col mb-1">
            <label for="nameLarge" class="form-label">Tanggal Mulai</label>
            <input type="text" name="tgl_mulai_tugas" class="form-control tanggal" placeholder="Masukan Tanggal Mulai" value="<?= $edit->tgl_mulai_tugas ?>" required>
        </div>

        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Tanggal Selesai</label>
            <input type="text" name="tgl_selesai_tugas" class="form-control tanggal" placeholder="Masukan Tanggal Selesai" value="<?= $edit->tgl_selesai_tugas ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col mb-1">
            <a href="<?= base_url('file/tugas/'.$edit->file_tugas) ?>" target="_blank">
                <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $edit->file_tugas ?></a>
                <p>

                    <label for="exampleInputText1">File Tugas <strong>Maks 10MB (pdf)</strong></label>
                    <input type="file" class="form-control-file" name="file_tugas">
                </div>
            </div>

            <div class="row">
                <div class="col mb-1">
                    <a>Tanggal Update Data Tugas : <a class="font-italic"><?= $edit->tgl_update_tugas ?></a></a>
                </div>
            </div>

        </div>

        <div class="modal-footer">
         <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="saving">Edit</button>
     </div>

 </form>

 <script type="text/javascript">
    /*Pilih Tanggal*/
    $('.tanggal').flatpickr({
        enableTime: true,
        time_24hr: true,
        dateFormat: "Y-m-d H:i",
    })

    /*Proses Edit Data Tugas*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Tugas?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_mengajar/proses_edit_data_tugas')?>",
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
                            text: "Data Tugas Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_tugas').DataTable().ajax.reload(null, false);
                            $('#modal_edit_data_tugas').modal('hide');
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