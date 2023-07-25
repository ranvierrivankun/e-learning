<form method="POST" id="form_tambah" enctype="multipart/form-data">

    <input type="hidden" name="id_jadpel_materi" value="<?= $where->id_jadpel ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Judul Materi</label>
                <input type="text" name="judul_materi" class="form-control" placeholder="Masukan Judul Materi" required>
            </div>

            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Deskripsi Materi</label>
                <textarea type="text" name="des_materi" class="form-control" placeholder="Masukan Deskripsi Materi" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col mb-1">
                <label for="exampleInputText1">File Materi <strong>Maks 10MB (pdf)</strong></label>
                <input type="file" class="form-control-file" name="file_materi">
            </div>
        </div>

    </div>

    <div class="modal-footer">
       <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
       <button type="submit" class="btn btn-primary" id="saving">Tambah</button>
   </div>

</form>

<script type="text/javascript">
/*Proses Tambah Data Materi*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Data Materi?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_mengajar/proses_tambah_data_materi')?>",
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
                            text: "Data Materi Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_materi').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_materi').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        /*$('#modal_tambah_data_materi').modal('hide');*/
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