<?php

require_once('functions.php');

$dataset_kasus = query("SELECT * FROM dataset_kasus dk JOIN tbl_usia tu ON dk.usia_id=tu.id JOIN tbl_pekerjaan tp ON dk.pekerjaan_id=tp.id JOIN tbl_penghasilan th ON dk.penghasilan_id=th.id JOIN tbl_asuransi ta ON dk.asuransi_id=ta.id JOIN tbl_pembayaran bayar ON dk.pembayaran_id=bayar.id JOIN tbl_klasifikasi tk ON dk.klasifikasi_id=tk.id");

?>

<!DOCTYPE html>
<html>

<head>
	<title>Program Naive Bayes</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">

	<style>
		table {
			text-align: center;
		}

		.table>tbody>tr>* {
			vertical-align: middle;
		}
	</style>

</head>

<body>

	<div class="container">
		<div class="row mt-4 justify-content-center">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h1>Program Naive Bayes</h1>
						<a href="dataset_latih.php" class="btn btn-success"><i class="fa fa-plus"></i> Dataset Latih</a>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>No.</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Usia</th>
								<th>Status</th>
								<th>Pekerjaan</th>
								<th>Penghasilan</th>
								<th>Masa Asuransi</th>
								<th>Cara Bayar</th>
								<th>Klasifikasi</th>
							</thead>
							<tbody>
								<?php foreach ($dataset_kasus as $num => $row) : ?>
									<tr>
										<td><?= $num + 1; ?></td>
										<td><?= $row["nama"]; ?></td>
										<td>
											<?php if ($row["jenkel"] == 1) : ?>
												Laki - Laki
											<?php else : ?>
												Perempuan
											<?php endif; ?>
										</td>
										<td><?= $row["usia"]; ?></td>
										<td>
											<?php if ($row["status"] == 1) : ?>
												Kawin
											<?php else : ?>
												Belum Kawin
											<?php endif; ?>
										</td>
										<td><?= $row['nama_pekerjaan']; ?></td>
										<td><?= $row['jumlah_penghasilan']; ?></td>
										<td><?= $row['masa']; ?></td>
										<td><?= $row['cara']; ?></td>
										<td><?= $row['klasifikasi']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>



</body>

</html>