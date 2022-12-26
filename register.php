<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['login_user'])) {
    header("Location: petugas.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama_user = $_POST['nama_user'];
    $email_user = $_POST['email_user'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['password']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (nama_user, username, email_user, password)
                    VALUES ('$nama_user', '$username', '$email_user', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script type='text/javascript'>alert('Selamat! akun anda berhasil didaftarkan. Silakan melakukan Login!');window.location='login.php'</script>";
                $username = "";
                $nama_user = "";
                $email_user = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script type='text/javascript'>alert('Terjadi kesalahan. Registrasi gagal!');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Username telah terdaftar.');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Password tidak sama.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- My CSS -->

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/style.css">k

  <title>E Perpus</title>
</head>

<body>

  <!-- Navbar start -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="petugas.php">E Perpus</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown me-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Contact
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li>
                <a class="dropdown-item" href="mailto:12.zeinirfansyah@gmail.com" target="blank">Email</a>
              </li>
              <li>
                <a class="dropdown-item"
                  href="https://wa.me/0895613982082?text=Hallo,%20Saya%20ingin%20bertanya%20sesuatu"
                  target="blank">Whatsapp</a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar end -->

  <!-- hero start -->
  <section id="home" class="hero">
    <div class="container">
      <div class="row text-center text-lg-start">
      <div class="col-md-6 mx-auto my-auto">
          <h1 class="display-4 fw-bolder">
            Selamat Datang di Aplikasi Money Management
          </h1>
          <p class="lead fw-normal">
            "Menabung adalah cara yang paling mudah untuk menghasilkan uang"
          </p>
          <hr class="mt-4 mb-4" />
          <div class="row">
            <p class="desc">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Corporis quas, culpa veritatis rerum dolores quia adipisci nam
              amet! Quidem eaque repellendus magnam officiis totam iste
              deserunt harum voluptatum temporibus velit.
            </p>
          </div>

        </div>
        <div class="col-md-6 mx-auto">
          <!-- Register Card start -->
        <div class="col">
          <div class="card card-form  ms-3 me-3 pb-4 shadow-sm p-2 mb-5 bg-body rounded">
              <h4 class="text-center mt-3">Registrasi Akun</h4>
              <div class="container">
                  <!-- Carousel start -->
                  <div id="carousel" class="carousel slide carousel-fade d-none d-md-block " data-bs-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active " data-bs-interval="2500">
                                  <img src="img/img1.svg" class="d-block img-fluid  ms-auto me-auto" style="height: 100px" alt="..." />
                              </div>
                              <div class="carousel-item" data-bs-interval="2500">
                                  <img src="img/img2.svg" class="d-block  img-fluid  ms-auto me-auto" style="height: 100px" alt="..." />
                              </div>
                          </div>
                      </div>
                      <!-- Carousel end -->
                  <form action="" method="POST" class="login-username">
                    <!-- nama petugas -->
                    <div class="mb-3 mt-3">
                          <div class="row">
                              <div class="col-md-4">
                                  <label for="nama_user" class="form-label">Nama Lengkap</label>
                              </div>
                              <div class="col">
                                  <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_user" value="<?php echo $nama_user; ?>" required>
                              </div>
                          </div>
                      </div>

                      <div class="mb-3 mt-3">
                          <div class="row">
                              <div class="col-md-4">
                                  <label for="username" class="form-label">Username</label>
                              </div>
                              <div class="col">
                                  <input class="form-control" type="username" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                              </div>
                          </div>
                      </div>

                      <div class="mb-3 mt-3">
                          <div class="row">
                              <div class="col-md-4">
                                  <label for="email_user" class="form-label">Email</label>
                              </div>
                              <div class="col">
                                  <input class="form-control" type="email" placeholder="Email" name="email_user" value="<?php echo $email_user; ?>" required>
                              </div>
                          </div>
                      </div>

                      <div class="mb-3">
                          <div class="row">
                              <div class="col-md-4">
                                  <label for="password" class="form-label">Password</label>
                              </div>
                              <div class="col">
                                  <input class="form-control" type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                              </div>
                          </div>
                      </div>

                      <div class="mb-3">
                          <div class="row">
                              <div class="col-md-4">
                                  <label for="cpassword" class="form-label">Confirm Password</label>
                              </div>
                              <div class="col">
                                  <input class="form-control" type="password" placeholder="Konfirmasi Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
                              </div>
                          </div>
                      </div>

                      <div class="mb-3 text-end">
                          <button name="submit" class="btn btn-outline-ungu ps-5 pe-5">Register</button>
                      </div>
                          <p class=" login-register-text text-end">Anda sudah punya akun? <a href="login.php">Login</a></p>
                  </form>
              </div>
          </div>
        </div>
        <!-- Register Card end -->
        </div>
      </div>
    </div>
  </section>
  <!-- hero end -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>

<!-- TRIBUTE GAMBAR 

<a href="https://storyset.com/health">Health illustrations by Storyset</a>

-->