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


    <link rel="stylesheet" href="css/style.css">

  <title>Money Management</title>
</head>

<body>

<!-- Login PHP start -->



<?php

include 'config.php';

error_reporting(0);

session_start();

// cek Cookie
if (isset($_COOKIE['id_user']) && isset($_COOKIE['key'])) {
    $id_user = $_COOKIE['id_user'];
    $key = $_COOKIE['key'];

    //ambil username
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id_user = $id_user");
    $row = mysqli_fetch_assoc($result);

    // cek username
    if ($key == hash('sha256', $row['username'])) {
        $_SESSION['login_user'] = true;
    }
}

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $cek_ketersediaan = mysqli_num_rows($result);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login_user'] = $row['username'];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['nama_user'] = $row['nama_user'];
        $_SESSION['email_user'] = $row['email_user'];
        $_SESSION['password'] = $row['password'];
        //cek remember me
        if (isset($_POST["remember"])) {
            //buat coookie
            //setcookie('login', 'true', time()+ 60);
            setcookie('id_user', $row['id_user'], time() + 3600);
            setcookie('key', hash('sha256', $row['username']), time() + 3600);
        }
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}

?>
<!-- --- -->

  <!-- Navbar start -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="petugas.php">Money Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">

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
          <!-- Login Card start -->
          <div class="col">
              <div class="card card-form ms-3 me-3 pb-4 shadow-sm p-3 mb-5 bg-body rounded">
                  <h4 class="text-center mt-3">Masuk</h4>
                  <div class="container">
                      <!-- Carousel start -->
                      <div id="carousel" class="carousel slide carousel-fade d-none d-md-block " data-bs-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active " data-bs-interval="2500">
                                  <img src="img/img1.svg" class="d-block img-fluid  ms-auto me-auto" style="height: 200px" alt="..." />
                              </div>
                              <div class="carousel-item" data-bs-interval="2500">
                                  <img src="img/img2.svg" class="d-block  img-fluid  ms-auto me-auto" style="height: 200px" alt="..." />
                              </div>
                          </div>
                      </div>
                      <!-- Carousel end -->


                      <form action="" method="POST" class="login-username">
                          <div class="mb-3 mt-3">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label for="username" class="form-label">Username</label>
                                  </div>
                                  <div class="col">
                                      <input class="form-control" type="username" placeholder="username" name="username" value="<?php echo $username; ?>" required>
                                  </div>
                              </div>

                          </div>
                          <div class="mb-3">
                              <div class="row">
                                  <div class="col-md-4">
                                      <label for="password" class="form-label">Password</label>
                                  </div>
                                  <div class="col">
                                      <input class="form-control" type="password" placeholder="password" name="password" value="<?php echo $_POST['password']; ?>" required>
                                  </div>
                              </div>
                          </div>
                          <div class="mb-3">
                              <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Remember me</label>
                          </div>
                          <div class="mb-3 text-end">
                              <button name="submit" class="btn btn-outline-ungu ps-5 pe-5">Login</button>
                          </div>
                          <p class=" login-register-text text-end">Anda belum punya akun? <a href="register.php">Register</a></p>
                      </form>
                  </div>
              </div>
          </div>
          <!-- Login Card end -->
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