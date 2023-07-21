<form method="POST" id="form_tambah" enctype="multipart/form-data">

 <div class="modal-body">

    <div class="row">

        <div class="col-lg-6">

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Kelas</label>
                <select class="form-control kelas" name="kelas" required>
                    <option value=""></option>
                </select>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">NISN</label>
                <input type="number" name="nisn" class="form-control" placeholder="Masukan NISN" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Status</label>
                <select name="status_siswa" class="form-control" required>
                    <option value="" selected>-- Pilih Status --</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

        </div>

        <div class="col-lg-6">

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" placeholder="Masukan Nama Siswa" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk_siswa" value="Pria" required>
                    <label class="form-check-label">Pria</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk_siswa" value="Wanita" required>
                    <label class="form-check-label">Wanita</label>
                </div>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Nomor Telepon</label>
                <input type="number" name="notelp_siswa" class="form-control" placeholder="Masukan Nomor Telepon" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Email</label>
                <input type="email" name="email_siswa" class="form-control" placeholder="Masukan Email" required>
            </div>

        </div>

    </div>

</div>

<div class="modal-footer">
   <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
   <button type="submit" class="btn btn-primary" id="saving">Tambah</button>
</div>

</form>

<script type="text/javascript">
     /*Select Kelas*/
    $(".kelas").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_tambah_data_siswa"),
        placeholder: 'Pilih Kelas',
        ajax: { 
            url: "<?= site_url('select/kelas')?>",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                searchTerm: params.term
            };
        },
        processResults: function (response) {
          return {
             results: response
         };
     },
     cache: true
 }
});

    /*Proses Tambah Data Siswa*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Data Siswa?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_siswa/proses_tambah_data_siswa')?>",
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
                            text: "Data Siswa Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_siswa').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_siswa').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        /*$('#modal_tambah_data_siswa').modal('hide');*/
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