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

    <title>DSS Peminjaman Kredit - Register</title>
  </head>
  <body>

    <!-- Content Start -->
    
    <div class="container">

    <div class="row">
        <h1></h1>
    </div>

    <div class="row">
            <div class="card">
                <!-- <img src="img-lagu/my-playlist1.jpg" class="card-img-top" alt="..."> -->
                <img src="img/dss-kredit.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title"><b>Halaman Register DSS Peminjaman Kredit</b></h4>
                    <p class="card-text">Isi form data di bawah ini terlebih dahulu untuk membuat akun.</p>
                    <form>
                        <!-- <input type="text" class="form-control" placeholder="Username" aria-label="Username"> -->
                        <div class="mb-3">
                            <label for="exampleInputUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="Username">
                            <!-- <div id="Username" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUsername" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="Username">
                            <!-- <div id="Username" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUsername" class="form-label">Email</label>
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="Username">
                            <!-- <div id="Username" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUsername" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="Username">
                            <!-- <div id="Username" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        
                        <a class="btn btn-secondary" href="index.php" role="button">Back</a>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <a class="btn btn-primary" href="profil.php" role="button">Submit</a>
                        <!-- <button class="btn btn-sm btn-outline-secondary" type="button">Logout</button> -->
                        <!-- <a class="btn btn-outline-secondary" href="halaman-awal.php" role="button">Logout</a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Content End -->

    <!-- footer -->
    <div class="container">
        <footer class="py-3 my-4">
            <!-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item">
                    <a href="playlist-main.php" class="nav-link px-2 text-muted">Home</a>
                </li>
                <li class="nav-item">
                    <a href="playlist-by-all-songs.php" class="nav-link px-2 text-muted">All Songs</a>
                </li>
                <li class="nav-item">
                    <a href="playlist-by-genre.php" class="nav-link px-2 text-muted">Genre</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-muted">Mood</a>
                </li>
                <li class="nav-item">
                    <a href="playlist-by-artist.php" class="nav-link px-2 text-muted">Artists</a>
                </li>
            </ul> -->
            <p class="text-center text-muted">© copyright 2021 | Rahmat Zaki Muharom</p>
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