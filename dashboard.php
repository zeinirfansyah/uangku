<?php 
session_start();
require 'config.php';

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
}

$username =  $_SESSION['login_user'];

// ambil data petugas berdasarkan session login
$sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$data = mysqli_fetch_array($sql);
$nama_user = $data['nama_user'];
$id_user = $data['id_user'];
$username = $data['username'];
$email_user = $data['email_user'];
$password = $data['password'];




$page = @$_GET['p'];
$aksi = @$_GET['aksi'];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>
         <?php
            if($page == 'transaksi') {
                if($aksi == 'tambah') {
                    echo "Tambah Transaksi";
                } else if($aksi == 'ubah') {
                    echo "Ubah Transaksi";
                } else {
                    echo "Halaman Transaksi";
                }
                
            } else {
                echo "Dashboard";
            }
        ?>
    </title>

    <link rel="stylesheet" href="css/style.css">
  </head>
    <body>
    <div class="wrapper">
        <div class="sidebar">
                <div class="profile">
                    <h4>Selamat Datang</h4>
                    <h5><?= $nama_user ?></h5>
                </div>
                <hr>
                <ul>
                <li>
                    <a href="?p=transaksi">
                        <span>Data transaksi</span>
                    </a>
                </li>
                <li class="logout_item">
                    <a href="?p=profile">Profile</a>
                    <a href="logout.php">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
           </div>
        </div>
        <div class="sidecontent">
            <main>
                <div class="container">
                <?php 

                if($page == 'transaksi') {
                    if($aksi == '') {
                        require_once 'page/transaksi/transaksi.php';
                    } else if($aksi == 'tambah') {
                        require_once 'page/transaksi/tambah_transaksi.php';
                    } else if($aksi == 'ubah') {
                        require_once 'page/transaksi/edit_transaksi.php';
                    } else if($aksi == 'hapus') {
                        require_once 'page/transaksi/hapus_transaksi.php';
                    }
                } else if($page == 'anggota') {
                    if($aksi == '') {
                        require_once 'page/anggota/anggota.php';
                    } else if($aksi == 'tambah') {
                        require_once 'page/anggota/tambah_anggota.php';
                    } else if($aksi == 'ubah') {
                        require_once 'page/anggota/edit_anggota.php';
                    } else if($aksi == 'hapus') {
                        require_once 'page/anggota/hapus_anggota.php';
                    }
                } else if($page == 'transaksi') {
                    if($aksi == '') {
                        require_once 'page/transaksi/transaksi.php';
                    } else if($aksi == 'tambah') {
                        require_once 'page/transaksi/tambah_transaksi.php';
                    } else if($aksi == 'kembali') {
                        require_once 'page/transaksi/kembali.php';
                    } else if($aksi == 'perpanjang') {
                        require_once 'page/transaksi/perpanjang.php';
                    } else if($aksi == 'laporan') {
                        require_once 'page/transaksi/laporan_transaksi.php';
                    }
                } else if ($page == 'transaksi_selesai') {
                    if($aksi == '') {
                        require_once 'page/transaksi/transaksi_selesai.php';
                    } else if($aksi == 'hapus') {
                        require_once 'page/transaksi/hapus_transaksi_selesai.php';
                    }
                } else if($page == 'profile') {
                    if ($aksi == '') {
                        require_once 'page/petugas/profile_petugas.php';
                    } else if ($aksi == 'ubah') {
                        require_once 'page/petugas/edit_petugas.php';
                    }
                } else { 
                    require_once 'page/transaksi/transaksi.php';
                }
            ?>
                    
                </div>
            </main>
        </div>
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
