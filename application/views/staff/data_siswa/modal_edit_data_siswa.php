<form method="POST" id="form_edit" enctype="multipart/form-data">

    <input type="hidden" name="id_siswa" value="<?= $edit->id_siswa ?>">

    <div class="modal-body">

        <div class="row">

            <div class="col-lg-6">

             <div class="mb-1">
                <label for="nameLarge" class="form-label">Kelas</label>
                <select class="form-control kelas" name="kelas" required>
                    <option value="<?= $edit->kelas ?>"><?= $edit->nama_kelas ?> - <?= $edit->nama_kejuruan ?></option></select>
             </select>
         </div>

         <div class="mb-1">
            <label for="nameLarge" class="form-label">NISN</label>
            <input type="number" name="nisn" class="form-control" placeholder="<?= $edit->nisn ?>">
        </div>

        <div class="mb-1">
            <label for="nameLarge" class="form-label">Password</label>
            <input type="text" name="password" class="form-control" placeholder="Masukan Password jika ingin mengubah">
        </div>

        <div class="mb-1">
            <label for="nameLarge" class="form-label">Status</label>
            <select name="status_siswa" class="form-control" required>
                <option value="<?= $edit->status_siswa ?>">
                    <?php if($edit->status_siswa == 'aktif') {?>
                        Terpilih - Aktif
                    <?php } else { ?>
                        Terpilih - Nonaktif   
                    <?php } ?>
                </option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

    </div>

    <div class="col-lg-6">

        <div class="mb-1">
            <label for="nameLarge" class="form-label">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="<?= $edit->nama_siswa ?>" placeholder="Masukan Nama Siswa" required>
        </div>

        <div class="mb-1">
            <label for="nameLarge" class="form-label">Jenis Kelamin</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk_siswa" value="Pria" <?php if($edit->jk_siswa == "Pria"){echo "checked";} ?> required>
                <label class="form-check-label">Pria</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk_siswa" value="Wanita" <?php if($edit->jk_siswa == "Wanita"){echo "checked";} ?> required>
                <label class="form-check-label">Wanita</label>
            </div>
        </div>

        <div class="mb-1">
            <label for="nameLarge" class="form-label">Nomor Telepon</label>
            <input type="number" name="notelp_siswa" class="form-control" value="<?= $edit->notelp_siswa ?>"placeholder="Masukan Nomor Telepon" required>
        </div>

        <div class="mb-1">
            <label for="nameLarge" class="form-label">Email</label>
            <input type="email" name="email_siswa" class="form-control" placeholder="<?= $edit->email_siswa ?>">
        </div>

    </div>

</div>

</div>

<div class="modal-footer">
 <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
 <button type="submit" class="btn btn-primary" id="saving">Edit</button>
</div>

</form>

<script type="text/javascript">
      /*Select Kelas*/
    $(".kelas").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_edit_data_siswa"),
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

    /*Proses Edit Data Siswa*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Siswa?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_siswa/proses_edit_data_siswa')?>",
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
                            text: "Data Siswa Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_siswa').DataTable().ajax.reload(null, false);
                            $('#modal_edit_data_siswa').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                       /*$('#modal_edit_data_siswa').modal('hide');*/
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