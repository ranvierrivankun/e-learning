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

            <h5 class="mt-3" align="center" style="font-weight: bold; color: black;">LAPORAN ABSENSI KELAS <?= $head->nama_kelas ?> - <?= $head->nama_kejuruan ?></h5>

            <table style="width: 100%; border-collapse: collapse !important; color: black;">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center;">NO</th>
                        <th>Mapel</th>
                        <th>Judul Absen</th>
                        <th>Nama Murid</th>
                        <th>Waktu Absen Murid</th>
                        <th>Pengajar</th>
                        <th>Waktu Absen Pengajar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)): ?>
                        <?php $no=1; foreach($data as $d) : ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= $d->nama_mapel ?></td>
                            <td>Pertemuan <?= $d->judul_absen ?></td>
                            <td><?= $d->nama_siswa ?></td>
                            <td>
                              <?php
                              if (empty($d->waktu_absen_murid)) {
                                echo $d->tgl_absen_murid . " / " . "Tidak Absen";
                            } else {
                                echo $d->tgl_absen_murid . " / " . $d->waktu_absen_murid;
                            }
                            ?>
                        </td>
                        <td><?= $d->nama_staff ?></td>
                        <td><?= $d->tgl_absen ?> / <?= $d->waktu_absen ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <td colspan="10" style="text-align: center;">Tidak ada Laporan Absensi</td>
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