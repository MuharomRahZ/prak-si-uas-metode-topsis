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

    <title>DSS Peminjaman Kredit - Data Penilaian</title>
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
                    <a class="nav-link active" aria-current="page" href="penilaian.php">Penilaian</a>
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
            <h1 style="margin-top:15px;">Data Penilaian</h1>
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
                    header("refresh:1;url=penilaian.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:1;url=penilaian.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="nmalternatif">ID Alternatif</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="idalternatif" name="idalternatif" value="<?php echo $idalternatif ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="values">ID Bobot Kriteria</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="idbobot" id="idbobot">
                                <option value="">- Pilih Kriteria -</option>
                                <option value="1" <?php if ($idbobot == 1) echo "selected" ?>>1 - Capacity</option>
                                <option value="2" <?php if ($idbobot == 2) echo "selected" ?>>2 - Character</option>
                                <option value="3" <?php if ($idbobot == 3) echo "selected" ?>>3 - Capital</option>
                                <option value="4" <?php if ($idbobot == 4) echo "selected" ?>>4 - Collateral</option>
                                <option value="5" <?php if ($idbobot == 5) echo "selected" ?>>5 - Condition</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="values">ID Sub-Kriteria</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="idsubkriteria" id="idsubkriteria">
                                <option value="">- Pilih Sub-Kriteria -</option>
                                <option value="1" <?php if ($idsubkriteria == 1) echo "selected" ?>>1 | Rp1.000.000 - Rp5.000.000 (Capacity)</option>
                                <option value="2" <?php if ($idsubkriteria == 2) echo "selected" ?>>2 | Rp5.000.000 - Rp10.000.000 (Capacity)</option>
                                <option value="3" <?php if ($idsubkriteria == 3) echo "selected" ?>>3 | Rp10.000.000 - Rp15.000.000 (Capacity)</option>
                                <option value="4" <?php if ($idsubkriteria == 4) echo "selected" ?>>4 | Rp15.000.000 - Rp20.000.000 (Capacity)</option>
                                <option value="5" <?php if ($idsubkriteria == 5) echo "selected" ?>>5 | >Rp20.000.000 (Capacity)</option>
                                <option value="6" <?php if ($idsubkriteria == 6) echo "selected" ?>>6 | 0,5 - 1,5 tahun (Character)</option>
                                <option value="7" <?php if ($idsubkriteria == 7) echo "selected" ?>>7 | 1,6 - 2,5 tahun (Character)</option>
                                <option value="8" <?php if ($idsubkriteria == 8) echo "selected" ?>>8 | 2,6 - 3,6 tahun (Character)</option>
                                <option value="9" <?php if ($idsubkriteria == 9) echo "selected" ?>>9 | 3,6 - 5 tahun (Character)</option>
                                <option value="10" <?php if ($idsubkriteria == 10) echo "selected" ?>>10 | Rp5.000.000 - Rp35.000.000 (Capital)</option>
                                <option value="11" <?php if ($idsubkriteria == 11) echo "selected" ?>>11 | Rp35.000.000 - Rp70.000.000 (Capital)</option>
                                <option value="12" <?php if ($idsubkriteria == 12) echo "selected" ?>>12 | Rp70.000.000 - Rp110.000.000 (Capital)</option>
                                <option value="13" <?php if ($idsubkriteria == 13) echo "selected" ?>>13 | Rp110.000.000 - Rp175.000.000 (Capital)</option>
                                <option value="14" <?php if ($idsubkriteria == 14) echo "selected" ?>>14 | Aset Kendaraan Bermotor (Collateral)</option>
                                <option value="15" <?php if ($idsubkriteria == 15) echo "selected" ?>>15 | Aset Surat Beharga & Saham (Collateral)</option>
                                <option value="16" <?php if ($idsubkriteria == 16) echo "selected" ?>>16 | Aset Properti (Collateral)</option>
                                <option value="17" <?php if ($idsubkriteria == 17) echo "selected" ?>>17 | Tidak Ada (Condition)</option>
                                <option value="18" <?php if ($idsubkriteria == 18) echo "selected" ?>>18 | 1 Orang (Condition)</option>
                                <option value="19" <?php if ($idsubkriteria == 19) echo "selected" ?>>19 | 2 Orang (Condition)</option>
                                <option value="20" <?php if ($idsubkriteria == 20) echo "selected" ?>>20 | 3 Orang (Condition)</option>
                                <option value="21" <?php if ($idsubkriteria == 21) echo "selected" ?>>21 | ≥ 4 Orang (Condition)</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="mb-3 row">
                        <div class="form-group">
                            <label for="values">Nama Kriteria</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="nmkriteria" id="nmkriteria">
                                <option value="">- Pilih Values -</option>
                                <option value="Capacity" <?php if ($nmkriteria == "Capacity") echo "selected" ?>>Capacity</option>
                                <option value="Character" <?php if ($nmkriteria == "Character") echo "selected" ?>>Character</option>
                                <option value="Capital" <?php if ($nmkriteria == "Capital") echo "selected" ?>>Capital</option>
                                <option value="Collateral" <?php if ($nmkriteria == "Collateral") echo "selected" ?>>Collateral</option>
                                <option value="Condition" <?php if ($nmkriteria == "Condition") echo "selected" ?>>Condition</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="nmsubkriteria">Nama Sub-Kriteria</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="nmsubkriteria" id="nmsubkriteria">
                                <option value="">- Pilih Sub-Kriteria -</option>
                                <option value="Rp1.000.000 - Rp5.000.000 (Capacity)" <?php if ($nmsubkriteria == "Rp1.000.000 - Rp5.000.000 (Capacity)") echo "selected" ?>>Rp1.000.000 - Rp5.000.000 (Capacity)</option>
                                <option value="Rp5.000.000 - Rp10.000.000 (Capacity)" <?php if ($nmsubkriteria == "Rp5.000.000 - Rp10.000.000 (Capacity)") echo "selected" ?>>Rp5.000.000 - Rp10.000.000 (Capacity)</option>
                                <option value="Rp10.000.000 - Rp15.000.000 (Capacity)" <?php if ($nmsubkriteria == "Rp10.000.000 - Rp15.000.000 (Capacity)") echo "selected" ?>>Rp10.000.000 - Rp15.000.000 (Capacity)</option>
                                <option value="Rp15.000.000 - Rp20.000.000 (Capacity)" <?php if ($nmsubkriteria == "Rp15.000.000 - Rp20.000.000 (Capacity)") echo "selected" ?>>Rp15.000.000 - Rp20.000.000 (Capacity)</option>
                                <option value="> Rp20.000.000 (Capacity)" <?php if ($nmsubkriteria == "> Rp20.000.000 (Capacity)") echo "selected" ?>>> Rp20.000.000 (Capacity)</option>
                                <option value="0,5 - 1,5 tahun (Character)" <?php if ($nmsubkriteria == "0,5 - 1,5 tahun (Character)") echo "selected" ?>>0,5 - 1,5 tahun (Character)</option>
                                <option value="1,6 - 2,5 tahun (Character)" <?php if ($nmsubkriteria == "1,6 - 2,5 tahun (Character)") echo "selected" ?>>1,6 - 2,5 tahun (Character)</option>
                                <option value="2,6 - 3,6 tahun (Character)" <?php if ($nmsubkriteria == "2,6 - 3,6 tahun (Character)") echo "selected" ?>>2,6 - 3,6 tahun (Character)</option>
                                <option value="3,6 - 5 tahun (Character)" <?php if ($nmsubkriteria == "3,6 - 5 tahun (Character)") echo "selected" ?>>3,6 - 5 tahun (Character)</option>
                                <option value="Rp5.000.000 - Rp35.000.000 (Capital)" <?php if ($nmsubkriteria == "Rp5.000.000 - Rp35.000.000 (Capital)") echo "selected" ?>>Rp5.000.000 - Rp35.000.000 (Capital)</option>
                                <option value="Rp35.000.000 - Rp70.000.000 (Capital)" <?php if ($nmsubkriteria == "Rp35.000.000 - Rp70.000.000 (Capital)") echo "selected" ?>>Rp35.000.000 - Rp70.000.000 (Capital)</option>
                                <option value="Rp70.000.000 - Rp110.000.000 (Capital)" <?php if ($nmsubkriteria == "Rp70.000.000 - Rp110.000.000 (Capital)") echo "selected" ?>>Rp70.000.000 - Rp110.000.000 (Capital)</option>
                                <option value="Rp110.000.000 - Rp175.000.000 (Capital)" <?php if ($nmsubkriteria == "Rp110.000.000 - Rp175.000.000 (Capital)") echo "selected" ?>>Rp110.000.000 - Rp175.000.000 (Capital)</option>
                                <option value="Aset Kendaraan Bermotor (Collateral)" <?php if ($nmsubkriteria == "Aset Kendaraan Bermotor (Collateral)") echo "selected" ?>>Aset Kendaraan Bermotor (Collateral)</option>
                                <option value="Aset Surat Beharga & Saham (Collateral)" <?php if ($nmsubkriteria == "Aset Surat Beharga & Saham (Collateral)") echo "selected" ?>>Aset Surat Beharga & Saham (Collateral)</option>
                                <option value="Aset Properti (Collateral)" <?php if ($nmsubkriteria == "Aset Properti (Collateral)") echo "selected" ?>>Aset Properti (Collateral)</option>
                                <option value="Tidak Ada (Condition)" <?php if ($nmsubkriteria == "Tidak Ada (Condition)") echo "selected" ?>>Tidak Ada (Condition)</option>
                                <option value="1 Orang (Condition)" <?php if ($nmsubkriteria == "1 Orang (Condition)") echo "selected" ?>>1 Orang (Condition)</option>
                                <option value="2 Orang (Condition)" <?php if ($nmsubkriteria == "2 Orang (Condition)") echo "selected" ?>>2 Orang (Condition)</option>
                                <option value="3 Orang (Condition)" <?php if ($nmsubkriteria == "3 Orang (Condition)") echo "selected" ?>>3 Orang (Condition)</option>
                                <option value="≥ 4 Orang (Condition)" <?php if ($nmsubkriteria == "≥ 4 Orang (Condition)") echo "selected" ?>>≥ 4 Orang (Condition)</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="values">Nilai</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="values" id="values">
                                <option value="">- Pilih Nilai -</option>
                                <option value="1" <?php if ($values == "1") echo "selected" ?>>1</option>
                                <option value="2" <?php if ($values == "2") echo "selected" ?>>2</option>
                                <option value="3" <?php if ($values == "3") echo "selected" ?>>3</option>
                                <option value="4" <?php if ($values == "4") echo "selected" ?>>4</option>
                                <option value="5" <?php if ($values == "5") echo "selected" ?>>5</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
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
                    </div> -->
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
                    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
                    <table class="table">
                        <tr>
                            <td>No</td>
                            <td>ID Alternatif</td>
                            <td>ID Bobot Kriteria</td>
                            <td>ID Sub-Kriteria</td>
                            <!-- <button onclick="deleteData()" type="button" class="btn btn-outline-danger">Hapus Semua Data</button> -->
                            <a href="penilaian.php?op=delsemua"><button onclick="return confirm('Yakin mau delete semua data?')" type="button" class="btn btn-outline-danger">Hapus Semua Data</button></a>

                            <!-- <script>
                                function deleteData(){
                                    $hostname = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname   = "cbpraksi22";

                                    $conn = mysqli_connect($hostname, $username, $password, $dbname);

                                    $stmt = $conn->prepare("DELETE FROM penilaian");
                                    $stmt->execute();
                                    echo $stmt->rowCount() . " baris terhapus";
                                }
                            </script> -->
                            <!-- <td>Nilai</td>
                            <td>Keterangan</td> -->
                        </tr>

                        <!-- dimulainya connection -->
                        <?php
                        include 'config.php';
                        $no = 1;
                        // $query = "SELECT matrixkeputusan.idmatrix,alternatif.*,kriteria.*,bobot.idbobot,bobot.values,subkriteria.idsubkriteria,subkriteria.nmsubkriteria,skala.values AS nilai,skala.keterangan FROM matrixkeputusan,skala,bobot,kriteria,subkriteria,alternatif WHERE matrixkeputusan.idalternatif=alternatif.idalternatif AND matrixkeputusan.idbobot=bobot.idbobot AND matrixkeputusan.idsubkriteria=subkriteria.idsubkriteria AND kriteria.idkriteria=bobot.idkriteria AND subkriteria.idskala=skala.idskala ORDER BY idmatrix";
                        $query = "SELECT * FROM matrixkeputusan";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_array()) { 
                            $idmatrix = $row['idmatrix'];
                            $idalternatif = $row['idalternatif'];
                            // $nmalternatif = $row['nmalternatif'];
                            // $idkriteria = $row['idkriteria'];
                            // $nmkriteria = $row['nmkriteria'];
                            $idbobot = $row['idbobot'];
                            // $values = $row['values'];
                            $idsubkriteria = $row['idsubkriteria'];
                            // $nmsubkriteria = $row['nmsubkriteria'];
                            // $nilai = $row['nilai'];
                            // $keterangan = $row['keterangan'];
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $idalternatif; ?></td>
                                <td><?php echo $idbobot; ?></td>
                                <td><?php echo $idsubkriteria; ?></td>
                                <td>
                                    <a href="penilaian.php?op=edit&idmatrix=<?php echo $idmatrix?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="penilaian.php?op=delete&idmatrix=<?php echo $idmatrix?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>

                                <!-- <td><?php echo $nmalternatif; ?></td>
                                <td><?php echo $nmkriteria; ?></td>
                                <td><?php echo $nmsubkriteria; ?></td>
                                <td><?php echo $nilai; ?></td>
                                <td><?php echo $keterangan; ?></td> -->
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