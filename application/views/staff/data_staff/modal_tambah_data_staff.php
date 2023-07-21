<form method="POST" id="form_tambah" enctype="multipart/form-data">

   <div class="modal-body">

    <div class="row">

        <div class="col-lg-6">

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Role</label>
                <select class="form-control role" name="role" required>
                    <option value=""></option>
                </select>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">NIK</label>
                <input type="number" name="nik" class="form-control" placeholder="Masukan NIK" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Status</label>
                <select name="status_staff" class="form-control" required>
                    <option value="" selected>-- Pilih Status --</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

        </div>

        <div class="col-lg-6">

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Nama</label>
                <input type="text" name="nama_staff" class="form-control" placeholder="Masukan Nama" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk_staff" value="Pria" required>
                    <label class="form-check-label">Pria</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk_staff" value="Wanita" required>
                    <label class="form-check-label">Wanita</label>
                </div>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Nomor Telepon</label>
                <input type="number" name="notelp_staff" class="form-control" placeholder="Masukan Nomor Telepon" required>
            </div>

            <div class="mb-1">
                <label for="nameLarge" class="form-label">Email</label>
                <input type="email" name="email_staff" class="form-control" placeholder="Masukan Email" required>
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
 /*Select Role*/
    $(".role").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_tambah_data_staff"),
        placeholder: 'Pilih Role',
        ajax: { 
            url: "<?= site_url('select/role')?>",
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

/*Proses Tambah Data Staff*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Data Staff?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_staff/proses_tambah_data_staff')?>",
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
                            text: "Data Staff Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_staff').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_staff').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        /*$('#modal_tambah_data_staff').modal('hide');*/
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