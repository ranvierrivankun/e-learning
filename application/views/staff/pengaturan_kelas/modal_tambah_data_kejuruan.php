<form method="POST" id="form_tambah" enctype="multipart/form-data">

   <div class="modal-body">

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Nama Kejuruan</label>
            <input type="text" name="nama_kejuruan" class="form-control" placeholder="Masukan Nama Kejuruan" required>
        </div>
    </div>

</div>

<div class="modal-footer">
 <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
 <button type="submit" class="btn btn-primary" id="saving">Tambah</button>
</div>

</form>

<script type="text/javascript">
/*Proses Tambah Data Kejuruan*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Data Kejuruan?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('pengaturan_kelas/proses_tambah_data_kejuruan')?>",
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
                            text: "Data Kejuruan Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_kejuruan').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_kejuruan').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        $('#modal_tambah_data_kejuruan').modal('hide');
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