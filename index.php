<?php
$data = file_get_contents('main-menu.json');
$menu = json_decode($data,true);

$menu = $menu["menu"];


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
        body{
            background: #f9f9f9;
        }
    </style>

    <title>DSS Peminjaman Kredit - Home</title>
  </head>
  <body>
    <!-- Nav Bar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><b>DSS Peminjaman Kredit</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="kriteria.php">Kriteria</a>
                    <a class="nav-link" href="subkriteria.php">Sub-Kriteria</a>
                    <a class="nav-link" href="alternatif.php">Alternatif</a>
                    <a class="nav-link" href="penilaian.php">Penilaian</a>
                    <a class="nav-link" href="detailnilai.php">Detail Penilaian</a>
                    <a class="nav-link" href="perhitungan.php">Perhitungan</a>
                    <a class="nav-link" href="hasil.php">Hasil Akhir</a>
                    <!-- <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Logout
                    </button> -->
                </div>
            </div>
        </div>
    </nav>
    <!-- Nav Bar End -->

    <!-- Content start -->
    <div class="row">
        <h1></h1>
    </div>


    <div class="container">
        <!-- Card-Intro Start -->
        <div class="row">
            <div class="card">
                <img src="img/dss-kredit.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title"><b>Selamat Datang Di DSS Peminjaman Kredit!</b></h4>
                    <p class="card-text">Sebuah website DSS untuk Membantu Proses Keputusan Peminjaman Kredit menggunakan Metode TOPSIS.</p>
                </div>
            </div>
        </div>
        <!-- Card-Intro End -->
        

        <div class="row">
            <h1></h1>
        </div>

        <!-- Card-Menu Start -->
        <div class="row">
            <?php foreach($menu as $row): ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row["nama"] ?></h5>
                        <div class="d-grid gap-2 mx-auto">
                            <a href="<?= $row["link"] ?>" class="btn btn-primary">Lihat</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Card-Menu End -->

        <!-- Modal Logout -->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Anda ingin keluar dari akun?  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="index.php" role="button">Keluar</a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Modal End -->


    </div>
    <!-- Content End -->

    <!-- footer start -->
    <div class="container">
        <footer class="py-3 my-4">
            <!-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-muted">Home</a>
                </li>
                <li class="nav-item">
                    <a href="alternatif.php" class="nav-link px-2 text-muted">Alternatif</a>
                </li>
                <li class="nav-item">
                    <a href="kriteria.php" class="nav-link px-2 text-muted">Kriteria</a>
                </li>
                <li class="nav-item">
                    <a href="pembobotan.php" class="nav-link px-2 text-muted">Bobot</a>
                </li>
                <li class="nav-item">
                    <a href="tingkat-cocok.php" class="nav-link px-2 text-muted">Skala</a>
                </li>
                <li class="nav-item">
                    <a href="hasil-prediksi.php" class="nav-link px-2 text-muted">Hasil Prediksi Cuaca</a>
                </li>
                <li class="nav-item">
                    <a href="profil.php" class="nav-link px-2 text-muted">Profil</a>
                </li>
            </ul> -->
            <!-- <p class="text-center text-muted">© copyright 2022 | Rahmat Zaki Muharom</p> -->
            <p class="text-center text-muted">Made by Rahmat Zaki Muharom</p>
        </footer>
    </div>
    <!-- Footer End -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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