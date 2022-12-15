<?php
// $data = file_get_contents('playlist-lagu.json');
// $lagu = json_decode($data,true);

// $lagu = $lagu["lagu"];

// echo $menu[0]["nama"];



?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        body{
            background: #f9f9f9;
        }
    </style>

    <title>DSS Peminjaman Kredit - Data Perhitungan</title>
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><b>DSS Peminjaman Kredit</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="kriteria.php">Kriteria</a>
                    <a class="nav-link" href="subkriteria.php">Sub-Kriteria</a>
                    <a class="nav-link" href="alternatif.php">Alternatif</a>
                    <a class="nav-link" href="penilaian.php">Penilaian</a>
                    <a class="nav-link" href="detailnilai.php">Detail Penilaian</a>
                    <a class="nav-link active" aria-current="page" href="perhitungan.php">Perhitungan</a>
                    <a class="nav-link" href="hasil.php">Hasil Akhir</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
    
    <!-- Content Start -->
    <div class="container">
        <div class="row">
            <h1 style="margin-top:15px;">Data Perhitungan</h1>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="container"> -->
                        <h3 style="margin-top:20px;">TOPSIS Pembagi</h3>
                        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>ID Kriteria</td>
                                <td>Nama Kriteria</td>
                                <td>Nilai Pembagi</td>
                            </tr>

                            <!-- dimulainya connection -->
                            <?php
                            include 'config.php';
                            $no = 1;
                            $query = "SELECT vmatrixkeputusan.idkriteria,vmatrixkeputusan.nmkriteria, SQRT(SUM(POW(vmatrixkeputusan.nilai,2))) AS bagi FROM vmatrixkeputusan GROUP BY vmatrixkeputusan.idkriteria ";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['idkriteria']; ?></td>
                                    <td><?php echo $row['nmkriteria']; ?></td>
                                    <td><?php echo $row['bagi']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>

                        <h3 style="margin-top:20px;">TOPSIS Normalisasi</h3>
                        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>ID Matrix</td>
                                <td>ID Alternatif</td>
                                <td>Nama Alternatif</td>
                                <td>ID Kriteria</td>
                                <td>Nama Kriteria</td>
                                <td>ID Bobot</td>
                                <td>Values</td>
                                <td>Nilai</td>
                                <td>Keterangan</td>
                                <td>Nilai Normalisasi</td>
                            </tr>

                            <!-- dimulainya connection -->
                            <?php
                            include 'config.php';
                            $no = 1;
                            $query = "SELECT vmatrixkeputusan.*,(vmatrixkeputusan.nilai/topsis_pembagi.bagi) AS normalisasi FROM vmatrixkeputusan,topsis_pembagi WHERE topsis_pembagi.idkriteria=vmatrixkeputusan.idkriteria GROUP BY vmatrixkeputusan.idmatrix ";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['idmatrix']; ?></td>
                                    <td><?php echo $row['idalternatif']; ?></td>
                                    <td><?php echo $row['nmalternatif']; ?></td>
                                    <td><?php echo $row['idkriteria']; ?></td>
                                    <td><?php echo $row['nmkriteria']; ?></td>
                                    <td><?php echo $row['idbobot']; ?></td>
                                    <td><?php echo $row['values']; ?></td>
                                    <td><?php echo $row['nilai']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><?php echo $row['normalisasi']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>

                        <h3 style="margin-top:20px;">TOPSIS Normalisasi Terbobot</h3>
                        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>ID Matrix</td>
                                <td>ID Alternatif</td>
                                <td>Nama Alternatif</td>
                                <td>ID Kriteria</td>
                                <td>Nama Kriteria</td>
                                <td>ID Bobot</td>
                                <td>Values</td>
                                <td>Nilai</td>
                                <td>Keterangan</td>
                                <td>Nilai Normalisasi</td>
                                <td>Normalisasi Terbobot</td>
                            </tr>

                            <!-- dimulainya connection -->
                            <?php
                            include 'config.php';
                            $no = 1;
                            $query = "SELECT topsis_normalisasi.*,(bobot.values*topsis_normalisasi.normalisasi) AS terbobot FROM topsis_normalisasi,bobot WHERE bobot.idkriteria=topsis_normalisasi.idkriteria GROUP BY topsis_normalisasi.idmatrix ";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['idmatrix']; ?></td>
                                    <td><?php echo $row['idalternatif']; ?></td>
                                    <td><?php echo $row['nmalternatif']; ?></td>
                                    <td><?php echo $row['idkriteria']; ?></td>
                                    <td><?php echo $row['nmkriteria']; ?></td>
                                    <td><?php echo $row['idbobot']; ?></td>
                                    <td><?php echo $row['values']; ?></td>
                                    <td><?php echo $row['nilai']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><?php echo $row['normalisasi']; ?></td>
                                    <td><?php echo $row['terbobot']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>

                        <h3 style="margin-top:20px;">TOPSIS Nilai Maksimum & Minimum</h3>
                        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>ID Matrix</td>
                                <td>ID Kriteria</td>
                                <td>Nama Kriteria</td>
                                <td>Nilai Maksimum</td>
                                <td>Nilai Minimum</td>
                            </tr>

                            <!-- dimulainya connection -->
                            <?php
                            include 'config.php';
                            $no = 1;
                            $query = "SELECT topsis_terbobot.idmatrix,topsis_terbobot.idkriteria,topsis_terbobot.nmkriteria,MAX(topsis_terbobot.terbobot) AS maximum,MIN(topsis_terbobot.terbobot) AS minimum FROM topsis_terbobot GROUP BY topsis_terbobot.idkriteria ";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['idmatrix']; ?></td>
                                    <td><?php echo $row['idkriteria']; ?></td>
                                    <td><?php echo $row['nmkriteria']; ?></td>
                                    <td><?php echo $row['maximum']; ?></td>
                                    <td><?php echo $row['minimum']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>

                        <h3 style="margin-top:20px;">TOPSIS SIP & SIN</h3>
                        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>ID Alternatif</td>
                                <td>Nilai DPlus</td>
                                <td>Nilai DMin</td>
                            </tr>

                            <!-- dimulainya connection -->
                            <?php
                            include 'config.php';
                            $no = 1;
                            $query = "SELECT topsis_terbobot.idalternatif, SQRT(SUM(POW((topsis_maxmin.maximum-topsis_terbobot.terbobot),2))) AS dplus,SQRT(SUM(POW((topsis_maxmin.minimum-topsis_terbobot.terbobot),2))) AS dmin FROM topsis_terbobot,topsis_maxmin WHERE topsis_terbobot.idkriteria=topsis_maxmin.idkriteria GROUP BY topsis_terbobot.idalternatif ";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['idalternatif']; ?></td>
                                    <td><?php echo $row['dplus']; ?></td>
                                    <td><?php echo $row['dmin']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>

                        <h3 style="margin-top:20px;">TOPSIS Nilai Preferensi Alternatif (V)</h3>
                        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>ID Alternatif</td>
                                <td>Nilai DPlus</td>
                                <td>Nilai DMin</td>
                                <td>Nilai V</td>
                            </tr>

                            <!-- dimulainya connection -->
                            <?php
                            include 'config.php';
                            $no = 1;
                            $query = "SELECT topsis_sipsin.*,(topsis_sipsin.dmin/(topsis_sipsin.dplus+topsis_sipsin.dmin)) AS nilaiv FROM topsis_sipsin GROUP BY topsis_sipsin.idalternatif ";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_array()) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['idalternatif']; ?></td>
                                    <td><?php echo $row['dplus']; ?></td>
                                    <td><?php echo $row['dmin']; ?></td>
                                    <td><?php echo $row['nilaiv']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- footer -->
    <div class="container">
        <footer class="py-3 my-4">
            <p class="text-center text-muted">Made by Rahmat Zaki Muharom</p>
        </footer>
    </div>
    <!-- end footer -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>