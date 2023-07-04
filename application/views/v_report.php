<!DOCTYPE html>
<html lang="en">

<head>


	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
		}



		table thead th {
			border: 1px solid black;
			text-align: left;
		}

		table tbody tr td {
			border: 1px solid black;
			text-align: left;
		}
	</style>
</head>

<body>
	<center>
		<h2>LAPORAN PDF REKAP ABSENSI</h2>
		<h3 style="color: red;">Absensi Pegawai</h3>
		<h5>Periode: <?= $dateStart . " s/d " . $dateEnd; ?></h5>
	</center>

	<br>
	<table>
		<thead>
			<th>No</th>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Tanggal</th>
			<th>Absen</th>
		</thead>

		<tbody>
			<?php
			$no  = 1;
			foreach ($absen as $trans) : ?>

				<tr>
					<td><?= $no++; ?></td>
					<td><?= $trans->nama; ?></td>
					<td><?= $trans->jabatan; ?></td>
					<td><?= $trans->waktu; ?></td>
					<td><?= $trans->jenis; ?></td>
				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>



</body>

</html>