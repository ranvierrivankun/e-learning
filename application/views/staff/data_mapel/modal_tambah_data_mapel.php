<form method="POST" id="form_tambah" enctype="multipart/form-data">

   <div class="modal-body">

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" placeholder="Masukan Nama Mata Pelajaran" required>
        </div>
    </div>

</div>

<div class="modal-footer">
 <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
 <button type="submit" class="btn btn-primary" id="saving">Tambah</button>
</div>

</form>

<script type="text/javascript">
/*Proses Tambah Data Mata Pelajaran*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Data Mata Pelajaran?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_mapel/proses_tambah_data_mapel')?>",
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
                            text: "Data Mata Pelajaran Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_mapel').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_mapel').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        $('#modal_tambah_data_mapel').modal('hide');
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