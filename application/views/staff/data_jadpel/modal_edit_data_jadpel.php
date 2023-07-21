<form method="POST" id="form_edit" enctype="multipart/form-data">

     <input type="hidden" name="id_jadpel" value="<?= $edit->id_jadpel ?>">

   <div class="modal-body">

    <div class="mb-1">
        <label for="nameLarge" class="form-label">Kelas</label>
        <select class="form-control kelas" name="kelas" required>
            <option value="<?= $edit->jadpel_kelas ?>"><?= $edit->nama_kelas ?> - <?= $edit->nama_kejuruan ?></option></select>
        </select>
    </div>

    <div class="mb-1">
        <label for="nameLarge" class="form-label">Mata Pelajaran</label>
        <select class="form-control mapel" name="mapel" required>
            <option value="<?= $edit->jadpel_mapel ?>"><?= $edit->nama_mapel ?></option></select>
        </select>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="mb-1">
                <label for="nameLarge" class="form-label">Hari</label>
                <select class="form-control hari" name="hari" required>
                    <option value="<?= $edit2->hari ?>"><?= $edit2->nama_hari ?></option></select>
                </select>
            </div>
        </div>
        <div class="col-4">
           <div class="mb-1">
            <label for="nameLarge" class="form-label">Waktu Mulai</label>
            <input type="text" name="waktu_mulai" class="form-control waktu_mulai" placeholder="Masukan Waktu Mulai" value="<?= $edit2->waktu_mulai ?>" required>
        </div>
    </div>
    <div class="col-4">
        <div class="mb-1">
            <label for="nameLarge" class="form-label">Waktu Selesai</label>
            <input type="text" name="waktu_selesai" class="form-control waktu_selesai" placeholder="Masukan Waktu Selesai" value="<?= $edit2->waktu_selesai ?>" required>
        </div>
    </div>
</div>

<div class="mb-1">
    <label for="nameLarge" class="form-label">Pengajar / Guru</label>
    <select class="form-control guru" name="pengajar" required>
        <option value="<?= $edit2->pengajar ?>"><?= $edit2->nama_staff ?></option></select>
    </select>
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
        dropdownParent: $("#modal_edit_data_jadpel"),
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

    /*Select Mata Pelajaran*/
    $(".mapel").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_edit_data_jadpel"),
        placeholder: 'Pilih Mata Pelajaran',
        ajax: { 
            url: "<?= site_url('select/mapel')?>",
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

    /*Select Hari*/
    $(".hari").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_edit_data_jadpel"),
        placeholder: 'Pilih Hari',
        ajax: { 
            url: "<?= site_url('select/hari')?>",
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

    /*Select Guru*/
    $(".guru").select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal_edit_data_jadpel"),
        placeholder: 'Pilih Pengajar',
        ajax: { 
            url: "<?= site_url('select/guru')?>",
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

    /*Mulai*/
    $('.waktu_mulai').flatpickr({
        enableTime: true,
        noCalendar: true,
        time_24hr: true,
        dateFormat: "H:i"
    })

    /*Selesai*/
    $('.waktu_selesai').flatpickr({
        enableTime: true,
        noCalendar: true,
        time_24hr: true,
        dateFormat: "H:i"
    })

    /*Proses Edit Data Jadpel*/
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Jadwal Pelajaran?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_jadpel/proses_edit_data_jadpel')?>",
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
                            text: "Data Jadwal Pelajaran Berhasil Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_data_jadpel').DataTable().ajax.reload(null, false);
                            $('#modal_edit_data_jadpel').modal('hide');
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