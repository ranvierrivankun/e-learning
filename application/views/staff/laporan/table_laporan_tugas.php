<!DOCTYPE html>
<html>
<head>

	<style type="text/css" media="screen">
		thead {
			border-bottom-style: solid;
			border-top-style: solid;
			border-width: thin; 
		}
		td {
			padding:  5px;
            font-size: 12px;
        }
        th {
         padding: 5px;
         font-size: 12px;
     }

 </style>

</head>
<body>

    <div class="col-lg-12">
        <div class="table-responsive">

            <h5 class="mt-3" align="center" style="font-weight: bold; color: black;">LAPORAN TUGAS KELAS <?= $head->nama_kelas ?> - <?= $head->nama_kejuruan ?></h5>

            <table style="width: 100%; border-collapse: collapse !important; color: black;">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center;">NO</th>
                        <th>Mapel</th>
                        <th>Nama</th>
                        <th>File Tugas</th>
                        <th>Deadline</th>
                        <th>Tanggal Upload</th>
                        <th>Nilai Tugas</th>
                        <th>Catatan Tugas</th>
                        <th>Penilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)): ?>
                        <?php $no=1; foreach($data as $d) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= $d->nama_mapel ?></td>
                            <td><?= $d->nama_siswa ?></td>
                            <td><a href="<?= $d->file_tugas_selesai ?>"><?= $d->file_tugas_selesai ?></a></td>
                            <td><?= $d->tgl_selesai_tugas ?></td>
                            <td><?= $d->tgl_tugas_selesai ?></td>
                            <td><?= $d->nilai_tugas ?></td>
                            <td><?= $d->catatan_tugas ?></td>
                            <td><?= $d->nama_staff ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <td colspan="10" style="text-align: center;">Tidak ada Laporan Tugas</td>
                <?php endif; ?>
            </tbody>
        </table>

        <br>

        <table>
            <tr>
                <td style="font-weight: bold; color: black;">DICETAK</td>
                <td style="font-weight: bold; color: black;">:</td>
                <td style="color: black;">
                    <?= $waktu ?>
                </td>
            </tr>
        </table>

    </div>
</div>
</body>
</html>