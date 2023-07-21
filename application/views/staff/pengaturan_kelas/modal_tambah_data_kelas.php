<form method="POST" id="form_tambah" enctype="multipart/form-data">

 <div class="modal-body">

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" placeholder="Masukan Nama Kelas" required>
        </div>
    </div>

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Nama Kejuruan</label>
            <select class="form-control kejuruan" name="kejuruan" required>
                <option value=""></option>
            </select>
        </div>
    </div>

</div>

<div class="modal-footer">
   <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
   <button type="submit" class="btn btn-primary" id="saving">Tambah</button>
</div>

</form>

<script type="text/javascript">
 /*Select Kejuruan*/
    $(".kejuruan").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_tambah_data_kelas"),
        placeholder: 'Pilih Kejuruan',
        ajax: { 
            url: "<?= site_url('select/kejuruan')?>",
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

/*Proses Tambah Data Kelas*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Data Kelas?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('pengaturan_kelas/proses_tambah_data_kelas')?>",
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
                            text: "Data Kelas Berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_kelas').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_kelas').modal('hide');
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        $('#modal_tambah_data_kelas').modal('hide');
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