<?php
include 'config.php';
$nmalternatif = "";
$nmkriteria = "";
$nmsubkriteria = "";
$values = "";
$keterangan = "";
$idalternatif = "";
$idbobot = "";
$idsubkriteria = "";
$sukses       = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delsemua'){
    $sql1 = "delete from matrixkeputusan";
    $q1 = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus semua data";
    }else{
        $error = "Gagal melakukan delete semua data. Error: ".mysqli_error($conn);
    }
}
if($op == 'delete'){
    // $idalternatif         = $_GET['idalternatif'];
    // $sql1       = "delete from alternatif where idalternatif = '$idalternatif'";
    $idmatrix         = $_GET['idmatrix'];
    $sql1       = "delete from matrixkeputusan where idmatrix = '$idmatrix'";
    $q1         = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data. Error: ".mysqli_error($conn);
    }
}
if ($op == 'edit') {
    // $idalternatif         = $_GET['idalternatif'];
    // $sql1       = "select * from alternatif where idalternatif = '$idalternatif'";
    $idmatrix         = $_GET['idmatrix'];
    $sql1       = "select * from matrixkeputusan where idmatrix = '$idmatrix'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $idalternatif        = $r1['idalternatif'];
    $idbobot        = $r1['idbobot'];
    $idsubkriteria        = $r1['idsubkriteria'];

    if ($idalternatif == '' && $idbobot == '' && $idsubkriteria == '') {
        $error = "Data tidak ditemukan. Error: ".mysqli_error($conn);
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $idalternatif       = $_POST['idalternatif'];
    $idbobot        = $_POST['idbobot'];
    $idsubkriteria        = $_POST['idsubkriteria'];

    if ($idalternatif && $idbobot && $idsubkriteria) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update matrixkeputusan set idalternatif = '$idalternatif',idbobot = '$idbobot',idsubkriteria = '$idsubkriteria' where idmatrix = '$idmatrix'";
            $q1         = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate. Error: ".mysqli_error($conn);
            }
        } else { //untuk insert
            $sql1   = "insert into matrixkeputusan(idalternatif,idbobot,idsubkriteria) values ('$idalternatif','$idbobot','$idsubkriteria')";
            $q1     = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data. Error: ".mysqli_error($conn);
            }
        }
    } else {
        $error = "Silakan masukkan semua data. Error: ".mysqli_error($conn);
    }
}
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

    <title>DSS Peminjaman Kredit - Detail Data Penilaian</title>
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
                    <a class="nav-link active" aria-current="page" href="detailnilai.php">Detail Penilaian</a>
                    <a class="nav-link" href="perhitungan.php">Perhitungan</a>
                    <a class="nav-link" href="hasil.php">Hasil Akhir</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
    
    <!-- Content Start -->
    <div class="container">
        <div class="row">
            <h1 style="margin-top:15px;">Detail Data Penilaian</h1>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                    <table class="table">
                        <tr>
                            <td>No</td>
                            <td>ID Alternatif</td>
                            <!-- <td>ID Bobot Kriteria</td>
                            <td>ID Sub-Kriteria</td> -->
                            
                            <td>Nama Alternatif</td>
                            <td>Nama Kriteria</td>
                            <td>Bobot Kriteria</td>
                            <td>Nama Sub-Kriteria</td>
                            <td>Nilai</td>
                            <td>Keterangan</td>
                        </tr>

                        <!-- dimulainya connection -->
                        <?php
                        include 'config.php';
                        $no = 1;
                        $query = "SELECT matrixkeputusan.idmatrix,alternatif.*,kriteria.*,bobot.idbobot,bobot.values,subkriteria.idsubkriteria,subkriteria.nmsubkriteria,skala.values AS nilai,skala.keterangan FROM matrixkeputusan,skala,bobot,kriteria,subkriteria,alternatif WHERE matrixkeputusan.idalternatif=alternatif.idalternatif AND matrixkeputusan.idbobot=bobot.idbobot AND matrixkeputusan.idsubkriteria=subkriteria.idsubkriteria AND kriteria.idkriteria=bobot.idkriteria AND subkriteria.idskala=skala.idskala ORDER BY idmatrix";
                        // $query = "SELECT * FROM matrixkeputusan";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_array()) { 
                            $idmatrix = $row['idmatrix'];
                            $idalternatif = $row['idalternatif'];
                            $nmalternatif = $row['nmalternatif'];
                            $idkriteria = $row['idkriteria'];
                            $nmkriteria = $row['nmkriteria'];
                            $idbobot = $row['idbobot'];
                            $values = $row['values'];
                            $idsubkriteria = $row['idsubkriteria'];
                            $nmsubkriteria = $row['nmsubkriteria'];
                            $nilai = $row['nilai'];
                            $keterangan = $row['keterangan'];
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $idalternatif; ?></td>

                                <!-- <td><?php echo $idbobot; ?></td>
                                <td><?php echo $idsubkriteria; ?></td> -->

                                <td><?php echo $nmalternatif; ?></td>
                                <td><?php echo $nmkriteria; ?></td>
                                <td><?php echo $values; ?></td>
                                <td><?php echo $nmsubkriteria; ?></td>
                                <td><?php echo $nilai; ?></td>
                                <td><?php echo $keterangan; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
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