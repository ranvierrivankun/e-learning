<!-- Modal Tambah Data Materi -->
<div class="modal" id="modal_tambah_data_materi" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Materi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div id="isimodaltambah"></div>
		</div>
	</div>
</div>

<!-- Modal Edit Data Materi -->
<div class="modal" id="modal_edit_data_materi" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Data Materi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div id="isimodaledit"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	 /*Modal Tambah Data Materi*/
	function modal_tambah_data_materi() {

		var id_jadpel = $('#id_jadpel').val();

		$.ajax({
			url: "<?= site_url('Jadwal_mengajar/modal_tambah_data_materi') ?>",
			method: "POST",
			data: {id_jadpel: id_jadpel},

			beforeSend: ()=> {
				Swal.fire({
					title : 'Menunggu',
					html : 'Memproses data',
					didOpen: () => {
						Swal.showLoading()
					}
				})
			},
			success: function(data) {
				Swal.close();
				$('#modal_tambah_data_materi').modal('show');
				$('#isimodaltambah').html(data);
			}
		});
	}

	/*Modal Edit Data Materi*/
	$('#table_data_materi').on('click', '.edit', function(e) {
		e.preventDefault();

		var id_materi = $(this).data('id_materi');

		$.ajax({
			url: "<?= site_url('Jadwal_mengajar/modal_edit_data_materi')?>",
			method: "POST",
			data: {id_materi: id_materi},

			beforeSend: ()=> {
				Swal.fire({
					title : 'Menunggu',
					html : 'Memproses data',
					didOpen: () => {
						Swal.showLoading()
					}
				})
			},

			success: (data)=> {
				Swal.close();
				$('#modal_edit_data_materi').modal('show');
				$('#isimodaledit').html(data);
			},

			error: (req, status, error)=> {
				Swal.fire({
					icon: 'error',
					title: `Gagal ${req.status}`,
					text: `Silahkan Coba Lagi`,
					timer: 1500
				})
			},
		})

	})

	/*Delete Data Materi*/
	function delete_data(id)
	{
		Swal.fire({
			title: 'Delete',
			text: "Hapus Data Materi?",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= site_url('Jadwal_mengajar/delete_data_materi') ?>",
					data : {
						id: id,
					},
					dataType: "json",
					success: function(response) {
						if(response.sukses){
							Swal.fire({
								icon: 'success',
								confirmButtonColor: '#697a8d',
								title: 'Berhasil',
								timer: 1000,
								text: response.sukses
							});
							reload_table_data_materi();
						}
					}
				})
			}
		})
	}
</script>