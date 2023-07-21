<form method="POST" id="form_edit" enctype="multipart/form-data">

    <input type="hidden" name="id_mapel" value="<?= $edit->id_mapel ?>">

    <div class="modal-body">

        <div class="row">
            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" class="form-control" placeholder="<?= $edit->nama_mapel ?>">
            </div>
        </div>

    </div>

    <div class="modal-footer">
     <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary" id="saving">Edit</button>
 </div>

</form>

<script type="text/javascript">
/*Proses Edit Data Mapel*/
   $('#form_edit').on('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: `Konfirmasi`,
        text: `Perbaharui Data Mata Pelajaran?`,
        icon: 'question',
        showCancelButton : true,
        confirmButtonText : 'Perbaharui',
        confirmButtonColor : '#696cff',
        cancelButtonText : 'Tidak',
        reverseButtons : true
    }).then((result)=> {
        if(result.value) {
            $.ajax({
                url: "<?= site_url('data_mapel/proses_edit_data_mapel')?>",
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
                        text: "Data Mata Pelajaran Berhasil Diperbaharui!",
                        timer: 1500,
                    }).then((e)=> {
                        $('#table_data_mapel').DataTable().ajax.reload(null, false);
                        $('#modal_edit_data_mapel').modal('hide');
                    });
                } else {
                  Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: data.keterangan,
                    timer: 3000,
                }).then((e)=> {
                 $('#modal_edit_data_mapel').modal('hide');
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