<?php
include 'config.php';
$nmsubkriteria = "";
$values = "";
$keterangan = "";
$idskala = "";
$sukses       = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $idsubkriteria         = $_GET['idsubkriteria'];
    $sql1       = "delete from subkriteria where idsubkriteria = '$idsubkriteria'";
    $q1         = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $idsubkriteria         = $_GET['idsubkriteria'];
    // $idskala = $_GET['idskala'];
    // $sql1       = "select subkriteria.nmsubkriteria,skala.values,skala.keterangan from subkriteria,skala where idsubkriteria = '$idsubkriteria' AND idskala = '$idskala' AND subkriteria.idskala = skala.idskala ";
    $sql1       = "select * from subkriteria where idsubkriteria = '$idsubkriteria'";
    // $sql1       = "select subkriteria.nmsubkriteria from subkriteria where idsubkriteria = '$idsubkriteria'; select skala.values,skala.keterangan from skala where idskala = '$idskala' ";
    $q1         = mysqli_query($conn, $sql1);
    // $q1         = mysqli_multi_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nmsubkriteria        = $r1['nmsubkriteria'];
    $idskala = $r1['idskala'];
    // $values = $r1['values'];
    // $keterangan = $r1['keterangan'];
    if ($nmsubkriteria == '' && $idskala = '') {
        $error = "Data tidak ditemukan";
    }
    // if($conn->multi_query($sql1)){
    //     $r1 = $conn->store_result();
    //     while($r2 = $r1->fetch_assoc()){
    //         $nmsubkriteria = $r2['nmsubkriteria'];
    //         // $values = $r2['values'];
    //         // $keterangan = $r2['keterangan'];
    //     }
    //     // $r1->free();

    //     $conn->next_result();
    //     $r1 = $conn->store_result();
    //     while($r2 = $r1->fetch_assoc()){
    //         $values = $r2['values'];
    //         $keterangan = $r2['keterangan'];
    //     }
    //     // $r1->free();

    //     if($nmsubkriteria == '' && $values == '' && $keterangan == ''){
    //         $error = "Data tidak ditemukan";
    //     }
    // }
}
if (isset($_POST['simpan'])) { //untuk create
    $nmsubkriteria       = $_POST['nmsubkriteria'];
    $idskala = $_POST['idskala'];
    // $values = $_POST['values'];
    // $keterangan = $_POST['keterangan'];

    if ($nmsubkriteria && $idskala) {
        if ($op == 'edit') { //untuk update
            // $sql1       = "update subkriteria set nmsubkriteria = '$nmalternatif',values = '$values',keterangan = '$keterangan' where idsubkriteria = '$idsubkriteria'";
            $sql1       = "update subkriteria set nmsubkriteria = '$nmsubkriteria',idskala = '$idskala' where idsubkriteria = '$idsubkriteria'";
            $q1         = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into subkriteria(nmsubkriteria,idskala) values ('$nmsubkriteria','$idskala')";
            $q1     = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
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

    <title>DSS Peminjaman Kredit - Data Sub-Kriteria</title>
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
                    <a class="nav-link active" aria-current="page" href="subkriteria.php">Sub-Kriteria</a>
                    <a class="nav-link" href="alternatif.php">Alternatif</a>
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
            <h1 style="margin-top:15px;">Data Sub-Kriteria</h1>
        </div>

        <!-- <div class="card">
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
                    header("refresh:2;url=subkriteria.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:2;url=subkriteria.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="nmsubkriteria">Nama Sub-Kriteria</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nmsubkriteria" name="nmsubkriteria" value="<?php echo $nmsubkriteria ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="values">Values</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="values" id="values">
                                <option value="">- Pilih Values -</option>
                                <option value="1" <?php if ($idskala == "1") echo "selected" ?>>1 - Sangat Rendah</option>
                                <option value="2" <?php if ($idskala == "2") echo "selected" ?>>2 - Rendah</option>
                                <option value="3" <?php if ($idskala == "3") echo "selected" ?>>3 - Cukup</option>
                                <option value="4" <?php if ($idskala == "4") echo "selected" ?>>4 - Tinggi</option>
                                <option value="5" <?php if ($idskala == "5") echo "selected" ?>>5 - Sangat Tinggi</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="nmsubkriteria">Keterangan</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="keterangan" id="keterangan">
                                <option value="">- Pilih Keterangan -</option>
                                <option value="Sangat Rendah" <?php if ($keterangan == "Sangat Rendah") echo "selected" ?>>Sangat Rendah</option>
                                <option value="Rendah" <?php if ($keterangan == "Rendah") echo "selected" ?>>Rendah</option>
                                <option value="Cukup" <?php if ($keterangan == "Cukup") echo "selected" ?>>Cukup</option>
                                <option value="Tinggi" <?php if ($keterangan == "Tinggi") echo "selected" ?>>Tinggi</option>
                                <option value="Sangat Tinggi" <?php if ($keterangan == "Sangat Tinggi") echo "selected" ?>>Sangat Tinggi</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div> -->

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- <button type="button" class="btn btn-primary"><a style="color: #ffffff;text-decoration:none;" href="formkriteria.php">Insert</a></button> -->
                    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                    <table class="table">
                        <tr>
                            <td>No</td>
                            <!-- <td>ID Sub-Kriteria</td> -->
                            <td>Nama Sub-Kriteria</td>
                            <td>Values</td>
                            <td>Keterangan</td>
                        </tr>

                        <!-- dimulainya connection -->
                        <?php
                        include 'config.php';
                        $no = 1;
                        $query = "SELECT subkriteria.*,skala.* FROM subkriteria,skala WHERE subkriteria.idskala=skala.idskala ORDER BY idsubkriteria ";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_array()) { 
                            $idsubkriteria = $row['idsubkriteria'];
                            $nmsubkriteria = $row['nmsubkriteria'];
                            $idskala = $row['idskala'];
                            $values = $row['values'];
                            $keterangan = $row['keterangan'];
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $nmsubkriteria; ?></td>
                                <td><?php echo $values; ?></td>
                                <td><?php echo $keterangan; ?></td>
                                <!-- <td>
                                    <a href="subkriteria.php?op=edit&idsubkriteria=<?php echo $idsubkriteria?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="subkriteria.php?op=delete&idsubkriteria=<?php echo $idsubkriteria?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td> -->
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
            </ul>
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