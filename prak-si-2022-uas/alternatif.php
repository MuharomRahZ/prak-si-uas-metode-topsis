<?php
include 'config.php';
$nmalternatif = "";
$sukses       = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delsemua'){
    $sql1 = "delete from alternatif";
    $q1 = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus semua data";
    }else{
        $error = "Gagal melakukan delete semua . Error: ".mysqli_error($conn);
    }
}
if($op == 'delete'){
    $idalternatif         = $_GET['idalternatif'];
    $sql1       = "delete from alternatif where idalternatif = '$idalternatif'";
    $q1         = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data. Error: ".mysqli_error($conn);
    }
}
if ($op == 'edit') {
    $idalternatif         = $_GET['idalternatif'];
    $sql1       = "select * from alternatif where idalternatif = '$idalternatif'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nmalternatif        = $r1['nmalternatif'];

    if ($nmalternatif == '') {
        $error = "Data tidak ditemukan. Error: ".mysqli_error($conn);
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nmalternatif       = $_POST['nmalternatif'];

    if ($nmalternatif) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update alternatif set nmalternatif = '$nmalternatif' where idalternatif = '$idalternatif'";
            $q1         = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate. Error: ".mysqli_error($conn);
            }
        } else { //untuk insert
            $sql1   = "insert into alternatif(nmalternatif) values ('$nmalternatif')";
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

    <title>DSS Peminjaman Kredit - Data Alternatif</title>
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
                    <a class="nav-link active" aria-current="page" href="alternatif.php">Alternatif</a>
                    <a class="nav-link" href="penilaian.php">Penilaian</a>
                    <a class="nav-link" href="detailnilai.php">Detail Penilaian</a>
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
            <h1 style="margin-top:15px;">Data Alternatif</h1>
        </div>

        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:1;url=alternatif.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:1;url=alternatif.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="nmalternatif">Nama Alternatif</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nmalternatif" name="nmalternatif" value="<?php echo $nmalternatif ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                        <input type="reset" name="reset" value="Reset" class="btn btn-secondary"/>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- <button type="button" class="btn btn-primary"><a style="color: #ffffff;text-decoration:none;" href="formkriteria.php">Insert</a></button> -->
                    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                    <table class="table">
                        <tr>
                            <td>No</td>
                            <td>ID Alternatif</td>
                            <td>Nama Alternatif</td>
                            <a href="alternatif.php?op=delsemua"><button onclick="return confirm('Yakin mau delete semua data?')" type="button" class="btn btn-outline-danger">Hapus Semua Data</button></a>
                        </tr>

                        <!-- dimulainya connection -->
                        <?php
                        include 'config.php';
                        $no = 1;
                        $query = "SELECT * FROM alternatif";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_array()) { 
                            $idalternatif = $row['idalternatif'];
                            $nmalternatif = $row['nmalternatif'];
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $idalternatif; ?></td>
                                <td><?php echo $nmalternatif; ?></td>
                                <td>
                                    <a href="alternatif.php?op=edit&idalternatif=<?php echo $idalternatif?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="alternatif.php?op=delete&idalternatif=<?php echo $idalternatif?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Content end -->

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