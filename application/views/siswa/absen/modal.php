<script type="text/javascript">
	/*Absen*/
	function absen()
	{
		var id_absen = $('#id_absen').val();

		Swal.fire({
			title: 'Absen',
			text: "Klik Absen untuk melanjutkan",
			icon: 'success',
			showCancelButton: true,
			confirmButtonColor: '#6aa84f',
			confirmButtonText: 'Absen',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "post",
					url: "<?= site_url('Jadwal_pelajaran/proses_absen') ?>",
					data : {
						id_absen: id_absen,
					},
					dataType: "json",
					success: function(response) {
						if(response.sukses){
							Swal.fire({
								icon: 'success',
								confirmButtonColor: '#697a8d',
								title: 'Berhasil',
								timer: 3000,
								text: response.sukses
							});
                     /*reload_table_data_absen();*/
							location.reload()
						}
					}
				})
			}else if (result.dismiss === Swal.DismissReason.cancel){
				Swal.fire({
					confirmButtonColor: '#6e7881',
					icon: 'info',
					text: `Anda Membatalkan`,
					timer: 1500
				})
			}
		})
	}
</script>