<form method="POST" id="form_tambah" enctype="multipart/form-data">

    <input type="hidden" name="id_jadpel_absen" value="<?= $where->id_jadpel ?>">

    <div class="modal-body">

        <div class="row">

            <?php

            /*Generate Pertemuan*/
            $id_jadpel      = $where->id_jadpel;
            $id_mapel       = $where->jadpel_mapel;
            $id_kelas       = $where->jadpel_kelas;

            /*$query          = $this->db->query("SELECT max(judul_absen) as ja FROM data_absen WHERE id_jadpel_absen, $id_jadpel")->row_array();*/

            $query          = $this->db->select_max('judul_absen')->from('data_absen')->join('data_jadpel','id_jadpel=id_jadpel_absen')->where('jadpel_mapel', $id_mapel)->where('jadpel_kelas', $id_kelas)->get()->row_array();
            $urutan         = $query['judul_absen'];
            $urutan++;
            $judul_absen    = $urutan;
            ?>

            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Pertemuan</label>
                <input type="text" name="judul_absen" class="form-control" placeholder="Masukan Pertemuan" value="<?= $judul_absen ?>" required readonly>
            </div>

            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Tanggal Absen</label>
                <input type="text" name="tgl_absen" class="form-control tanggal" value="<?= date('Y-m-d') ?>" placeholder="Masukan Tanggal Absen" required>
            </div>
        </div>

        <div class="row">
            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Jam Mulai</label>
                <input type="text" class="form-control" value="<?= $where->waktu_mulai ?>" disabled>
            </div>

            <div class="col mb-1">
                <label for="nameLarge" class="form-label">Jam Selesai</label>
                <input type="text" class="form-control" value="<?= $where->waktu_selesai ?>" disabled>
            </div>
        </div>

    </div>

    <div class="modal-footer">
     <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary" id="saving">Buka</button>
 </div>

</form>

<script type="text/javascript">
    /*Pilih Tanggal*/
    $('.tanggal').flatpickr({
        dateFormat: "Y-m-d",
    })

/*Proses Tambah Data Absen*/
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Buka Absen?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Buka',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('Jadwal_mengajar/proses_tambah_data_absen')?>",
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
                            text: "Absen Berhasil dibuka!",
                            timer: 1500,
                        }).then((e)=> {
 /*                           $('#table_data_absen').DataTable().ajax.reload(null, false);
                            $('#modal_tambah_data_absen').modal('hide');*/
                            location.reload()
                        });
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: data.keterangan,
                        timer: 3000,
                    }).then((e)=> {
                        /*$('#modal_tambah_data_absen').modal('hide');*/
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