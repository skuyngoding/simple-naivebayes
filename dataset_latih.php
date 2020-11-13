<?php

require_once('functions.php');
$usia = query("SELECT * FROM tbl_usia");
$pekerjaan = query("SELECT * FROM tbl_pekerjaan");
$penghasilan = query("SELECT * FROM tbl_penghasilan");
$asuransi = query("SELECT * FROM tbl_asuransi");
$pembayaran = query("SELECT * FROM tbl_pembayaran");
$klasifikasi = query("SELECT * FROM tbl_klasifikasi");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dataset Latih - Program Naive Bayes</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <style>
        body {
            height: 800px;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row mt-4">
            <div class="col">
                <div class="card p-3">
                    <div class="card-header">
                        <h1>Dataset Latih</h1>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenkel">Jenis Kelamin</label>
                                        <select name="jenkel" class="form-control" id="jenkel" name="jenkel" required>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="usia_id">Usia</label>
                                        <select name="usia_id" class="form-control" id="usia_id" name="usia_id" required>
                                            <option value="">-- Pilih Usia --</option>
                                            <?php foreach ($usia as $row) : ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['usia']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status" name="status" required>
                                            <option value="1">Kawin</option>
                                            <option value="2">Belum Kawin</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <label for="pekerjaan_id">Pekerjaan</label>
                                <select name="pekerjaan_id" class="form-control" id="pekerjaan_id" name="pekerjaan_id" required>
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <?php foreach ($pekerjaan as $row) : ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['nama_pekerjaan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="penghasilan_id">Penghasilan</label>
                                <select name="penghasilan_id" class="form-control" id="penghasilan_id" name="penghasilan_id" required>
                                    <option value="">-- Pilih Penghasilan --</option>
                                    <?php foreach ($penghasilan as $row) : ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['jumlah_penghasilan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="asuransi_id">Asuransi</label>
                                <select name="asuransi_id" class="form-control" id="asuransi_id" name="asuransi_id" required>
                                    <option value="">-- Pilih Asuransi --</option>
                                    <?php foreach ($asuransi as $row) : ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['masa']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pembayaran_id">Pembayaran</label>
                                <select name="pembayaran_id" class="form-control" id="pembayaran_id" name="pembayaran_id" required>
                                    <option value="">-- Pilih Pembayaran --</option>
                                    <?php foreach ($pembayaran as $row) : ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['cara']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <a href="index.php" class="btn btn-warning">kembali</a>
                                <button type="submit" name="proses" class="btn btn-success">Cek Hasil</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($_POST['proses'])) {
            // dataset latih
            $nama = htmlspecialchars($_POST["nama"]);
            $jenkel = htmlspecialchars($_POST["jenkel"]);
            $usia_id = htmlspecialchars($_POST["usia_id"]);
            $status = htmlspecialchars($_POST["status"]);
            $pekerjaan_id = htmlspecialchars($_POST["pekerjaan_id"]);
            $penghasilan_id = htmlspecialchars($_POST["penghasilan_id"]);
            $asuransi_id = htmlspecialchars($_POST["asuransi_id"]);
            $pembayaran_id = htmlspecialchars($_POST["pembayaran_id"]);

            // Algoritma
            // 1. menghitung prior probabilities P(Ci) dari setiap jenis Klasifikasi, terdapat 3 class.
            $sql =  query("SELECT klasifikasi_id FROM dataset_kasus");
            $jmlKlasifikasi = count($sql);

            // Hitung Jumlah Masing-masing jenis Klasifikasi
            $sql =  query("SELECT klasifikasi_id FROM dataset_kasus WHERE klasifikasi_id = 1");
            $jmlKlasKurangLancar = count($sql);
            $sql =  query("SELECT klasifikasi_id FROM dataset_kasus WHERE klasifikasi_id = 2");
            $jmlKlasLancar = count($sql);
            $sql =  query("SELECT klasifikasi_id FROM dataset_kasus WHERE klasifikasi_id = 3");
            $jmlKlasTidakLancar = count($sql);

            // Menghitung PCi
            $pKlasKurangLancar = $jmlKlasKurangLancar / $jmlKlasifikasi;
            $pKlasLancar = $jmlKlasLancar / $jmlKlasifikasi;
            $pKlasTidakLancar = $jmlKlasTidakLancar / $jmlKlasifikasi;

            // 2. menghitung conditional probabilities P(Xt|Ci) dengan kriteria Laki-laki, usia 30-40 tahun, kawin, wiraswasta, 25-50 juta, 11 - 15 tahun, semesteran.
            $sql =  query("SELECT jenkel FROM dataset_kasus WHERE jenkel = " . $jenkel . " && klasifikasi_id = 1");
            $jmlJkKlasKurangLancar = count($sql);
            $sql =  query("SELECT jenkel FROM dataset_kasus WHERE jenkel = " . $jenkel . " && klasifikasi_id = 2");
            $jmlJkKlasLancar = count($sql);
            $sql =  query("SELECT jenkel FROM dataset_kasus WHERE jenkel = " . $jenkel . " && klasifikasi_id = 3");
            $jmlJkKlasTidakLancar = count($sql);

            // Probabilitas P(Jenis Kelamin | Jenis Klasifikasi)
            $jmlJkKlasKurangLancar = $jmlJkKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlJkKlasLancar = $jmlJkKlasLancar / $jmlKlasLancar;
            $jmlJkKlasTidakLancar = $jmlJkKlasTidakLancar / $jmlKlasTidakLancar;

            $sql =  query("SELECT usia_id FROM dataset_kasus WHERE usia_id = " . $usia_id . " && klasifikasi_id = 1");
            $jmlUsiaKlasKurangLancar = count($sql);
            $sql =  query("SELECT usia_id FROM dataset_kasus WHERE usia_id = " . $usia_id . " && klasifikasi_id = 2");
            $jmlUsiaKlasLancar = count($sql);
            $sql =  query("SELECT usia_id FROM dataset_kasus WHERE usia_id = " . $usia_id . " && klasifikasi_id = 3");
            $jmlUsiaKlasTidakLancar = count($sql);

            // Probabilitas P(Usia | Jenis Klasifikasi)
            $jmlUsiaKlasKurangLancar = $jmlUsiaKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlUsiaKlasLancar = $jmlUsiaKlasLancar / $jmlKlasLancar;
            $jmlUsiaKlasTidakLancar = $jmlUsiaKlasTidakLancar / $jmlKlasTidakLancar;

            $sql =  query("SELECT status FROM dataset_kasus WHERE status = " . $status . " && klasifikasi_id = 1");
            $jmlStatusKlasKurangLancar = count($sql);
            $sql =  query("SELECT status FROM dataset_kasus WHERE status = " . $status . " && klasifikasi_id = 2");
            $jmlStatusKlasLancar = count($sql);
            $sql =  query("SELECT status FROM dataset_kasus WHERE status = " . $status . " && klasifikasi_id = 3");
            $jmlStatusKlasTidakLancar = count($sql);

            // Probabilitas P(status | Jenis Klasifikasi)
            $jmlStatusKlasKurangLancar = $jmlStatusKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlStatusKlasLancar = $jmlStatusKlasLancar / $jmlKlasLancar;
            $jmlStatusKlasTidakLancar = $jmlStatusKlasTidakLancar / $jmlKlasTidakLancar;

            $sql =  query("SELECT pekerjaan_id FROM dataset_kasus WHERE pekerjaan_id = " . $pekerjaan_id . " && klasifikasi_id = 1");
            $jmlPekKlasKurangLancar = count($sql);
            $sql =  query("SELECT pekerjaan_id FROM dataset_kasus WHERE pekerjaan_id = " . $pekerjaan_id . " && klasifikasi_id = 2");
            $jmlPekKlasLancar = count($sql);
            $sql =  query("SELECT pekerjaan_id FROM dataset_kasus WHERE pekerjaan_id = " . $pekerjaan_id . " && klasifikasi_id = 3");
            $jmlPekKlasTidakLancar = count($sql);

            // Probabilitas P(Pekerjaan | Jenis Klasifikasi)
            $jmlPekKlasKurangLancar = $jmlPekKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlPekKlasLancar = $jmlPekKlasLancar / $jmlKlasLancar;
            $jmlPekKlasTidakLancar = $jmlPekKlasTidakLancar / $jmlKlasTidakLancar;


            $sql =  query("SELECT penghasilan_id FROM dataset_kasus WHERE penghasilan_id = " . $penghasilan_id . " && klasifikasi_id = 1");
            $jmlHasilKlasKurangLancar = count($sql);
            $sql =  query("SELECT penghasilan_id FROM dataset_kasus WHERE penghasilan_id = " . $penghasilan_id . " && klasifikasi_id = 2");
            $jmlHasilKlasLancar = count($sql);
            $sql =  query("SELECT penghasilan_id FROM dataset_kasus WHERE penghasilan_id = " . $penghasilan_id . " && klasifikasi_id = 3");
            $jmlHasilKlasTidakLancar = count($sql);

            // Probabilitas P(Penghasilan | Jenis Klasifikasi)
            $jmlHasilKlasKurangLancar = $jmlHasilKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlHasilKlasLancar = $jmlHasilKlasLancar / $jmlKlasLancar;
            $jmlHasilKlasTidakLancar = $jmlHasilKlasTidakLancar / $jmlKlasTidakLancar;

            $sql =  query("SELECT asuransi_id FROM dataset_kasus WHERE asuransi_id = " . $asuransi_id . " && klasifikasi_id = 1");
            $jmlAsrKlasKurangLancar = count($sql);
            $sql =  query("SELECT asuransi_id FROM dataset_kasus WHERE asuransi_id = " . $asuransi_id . " && klasifikasi_id = 2");
            $jmlAsrKlasLancar = count($sql);
            $sql =  query("SELECT asuransi_id FROM dataset_kasus WHERE asuransi_id = " . $asuransi_id . " && klasifikasi_id = 3");
            $jmlAsrKlasTidakLancar = count($sql);

            // Probabilitas P(Masa Asuransi | Jenis Klasifikasi)
            $jmlAsrKlasKurangLancar = $jmlAsrKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlAsrKlasLancar = $jmlAsrKlasLancar / $jmlKlasLancar;
            $jmlAsrKlasTidakLancar = $jmlAsrKlasTidakLancar / $jmlKlasTidakLancar;

            $sql =  query("SELECT pembayaran_id FROM dataset_kasus WHERE pembayaran_id = " . $pembayaran_id . " && klasifikasi_id = 1");
            $jmlBayarKlasKurangLancar = count($sql);
            $sql =  query("SELECT pembayaran_id FROM dataset_kasus WHERE pembayaran_id = " . $pembayaran_id . " && klasifikasi_id = 2");
            $jmlBayarKlasLancar = count($sql);
            $sql =  query("SELECT pembayaran_id FROM dataset_kasus WHERE pembayaran_id = " . $pembayaran_id . " && klasifikasi_id = 3");
            $jmlBayarKlasTidakLancar = count($sql);

            // Probabilitas P(Cara Pembayaran | Jenis Klasifikasi)
            $jmlBayarKlasKurangLancar = $jmlBayarKlasKurangLancar / $jmlKlasKurangLancar;
            $jmlBayarKlasLancar = $jmlBayarKlasLancar / $jmlKlasLancar;
            $jmlBayarKlasTidakLancar = $jmlBayarKlasTidakLancar / $jmlKlasTidakLancar;

            // 3. Menghitung posterior probabilities P(X|Ci)
            $posKlasKurangLancar = $jmlJkKlasKurangLancar * $jmlUsiaKlasKurangLancar * $jmlStatusKlasKurangLancar * $jmlPekKlasKurangLancar * $jmlHasilKlasKurangLancar * $jmlAsrKlasKurangLancar * $jmlBayarKlasKurangLancar;

            $posKlasLancar = $jmlJkKlasLancar * $jmlUsiaKlasLancar * $jmlStatusKlasLancar * $jmlPekKlasLancar * $jmlHasilKlasLancar * $jmlAsrKlasLancar * $jmlBayarKlasLancar;

            $posKlasTidakLancar = $jmlJkKlasTidakLancar * $jmlUsiaKlasTidakLancar * $jmlStatusKlasTidakLancar * $jmlPekKlasTidakLancar * $jmlHasilKlasTidakLancar * $jmlAsrKlasTidakLancar * $jmlBayarKlasTidakLancar;


            // 4. menghitung posterior probabilities P(Ci|X)
            $pKlasKurangLancar =  $pKlasKurangLancar * $posKlasKurangLancar;
            $pKlasLancar =  $pKlasLancar * $posKlasLancar;
            $pKlasTidakLancar =  $pKlasTidakLancar * $posKlasTidakLancar;

            if ($pKlasKurangLancar != 0) {
                $pKlasKurangLancar = number_format($pKlasKurangLancar, 10);
            } else {
                $pKlasKurangLancar =  0;
            }
            if ($pKlasLancar != 0) {
                $pKlasLancar = number_format($pKlasLancar, 10);
            } else {
                $pKlasLancar =  0;
            }
            if ($pKlasTidakLancar != 0) {
                $pKlasTidakLancar = number_format($pKlasTidakLancar, 10);
            } else {
                $pKlasTidakLancar =  0;
            }

            echo '<div class="alert alert-info mt-3 p-2" role="alert">
						Nilai posterior probabilities untuk <strong>Klasifikasi Kurang Lancar</strong> adalah : <strong>' . $pKlasKurangLancar . '</strong>, <strong>Klasifikasi Lancar</strong> adalah : <strong>' .  $pKlasLancar . '</strong>,  <strong>Klasifikasi Tidak Lancar</strong> adalah : <strong>' .  $pKlasTidakLancar . '</strong>
                    </div>';

            if ($pKlasKurangLancar > $pKlasLancar && $pKlasKurangLancar > $pKlasTidakLancar) {
                echo "<div class=\"alert alert-info mt-3 p-2\" role=\"alert\">Karena nilai Klasifikasi Kurang Lancar lebih besar daripada yang lain, maka " . $nama . " masuk ke <strong>Klasifikasi Kurang Lancar</strong></div>";
            } else if ($pKlasLancar > $pKlasKurangLancar && $pKlasLancar > $pKlasTidakLancar) {
                echo "<div class=\"alert alert-info mt-3 p-2\" role=\"alert\">Karena nilai Klasifikasi Lancar lebih besar daripada yang lain, maka " . $nama . " masuk ke <strong>Klasifikasi Lancar</strong></div>";
            } else if ($pKlasTidakLancar > $pKlasKurangLancar && $pKlasTidakLancar > $pKlasLancar) {
                echo "<div class=\"alert alert-info mt-3 p-2\" role=\"alert\">Karena nilai Klasifikasi Tidak Lancar lebih besar daripada yang lain, maka " . $nama . " masuk ke <strong>Klasifikasi Tidak Lancar</strong></div>";
            }
        } ?>

    </div>

</body>

</html>