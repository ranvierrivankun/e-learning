<form method="POST" id="form_edit" enctype="multipart/form-data">

    <input type="hidden" name="id_absen" value="<?= $edit->id_absen ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Judul Absen</label>
                <input type="text" name="judul_absen" class="form-control" placeholder="Masukan Judul Absen" value="<?= $edit->judul_absen ?>" required>
            </div>

            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Tanggal Absen</label>
                <input type="text" name="tgl_absen" class="form-control" value="<?= $edit->tgl_absen ?>"placeholder="Masukan Tanggal Absen" required readonly>
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
        dateFormat: "Y-m-d",
    })

     /*Proses Edit Data Absen*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Absen?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_mengajar/proses_edit_data_absen')?>",
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
                            text: "Data Absen Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_absen').DataTable().ajax.reload(null, false);
                            $('#modal_edit_data_absen').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                           /*$('#modal_edit_data_absen').modal('hide');*/
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