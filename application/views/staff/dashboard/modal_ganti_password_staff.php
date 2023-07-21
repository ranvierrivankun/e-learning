<form method="POST" id="form_ganti_password" enctype="multipart/form-data">

 <div class="modal-body">

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Password Lama</label>
            <input type="password" id="password_lama" name="password_lama" class="form-control" placeholder="Masukan Password Lama" required>
        </div>
    </div>

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Password Baru</label>
            <input type="password" id="password_baru_1" name="password_baru_1" class="form-control" placeholder="Masukan Password Baru" required>
        </div>
    </div>

    <div class="row">
        <div class="col mb-1">
            <label for="nameLarge" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" id="password_baru_2" name="password_baru_2" class="form-control" placeholder="Ketik Ulang Password Baru" required>
            <small id="status_password_baru"></small>
        </div>
    </div>

</div>

<div class="modal-footer">
   <button type="button" class="btn btn-seccess" data-dismiss="modal">Close</button>
   <button type="submit" class="btn btn-primary" id="saving">Ganti Password</button>
</div>

</form>

<!-- Proses Ganti Password -->
<script type="text/javascript">
    $('#form_ganti_password').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Password?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#696cff',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('dashboard_staff/proses_ganti_password_staff') ?>",
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
                                text: "Password Diperbaharui!",
                                timer: 1500,
                            }).then((e)=> {
                                $('#modal_ganti_password_staff').modal('hide');
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: data.keterangan,
                                timer: 1500,
                            }).then((e)=> {
                                $('#modal_ganti_password_staff').modal('hide');
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
            }
        })
    })
</script>

<!-- Validasi -->
<script type="text/javascript">
    $('#password_baru_2').on('keyup', function(e) {
        e.preventDefault();

        var pass1 = $('#password_baru_1').val();
        var pass2 = $('#password_baru_2').val();

        if(pass2 == "") {
            $('#status_password_baru').html('');
            $('#password_baru_2').removeClass('border-danger');
            $('#saving').attr('disabled', false);
        } else if(pass1 != pass2) {
            $('#status_password_baru').html(`<span class='text-danger'>Password Baru Tidak Sama!</span>`);
            $('#password_baru_2').addClass('border-danger');
            $('#saving').attr('disabled', true);
        } else {
            $('#status_password_baru').html('');
            $('#password_baru_2').removeClass('border-danger');
            $('#saving').attr('disabled', false);
        }
    })
</script>