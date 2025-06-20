<?php
session_start();
require_once 'admin/controller/koneksi.php';
require_once 'admin/controller/functions.php';
if (isset($_POST['login'])) {
  $email    = $_POST['email'];
  $password = $_POST['password'];

  $queryLogin = mysqli_query($connection, "SELECT * FROM user WHERE email='$email' AND password='$password'");

  // mysqli_num_row() : untuk melihat total data di dalam table
  if (mysqli_num_rows($queryLogin) > 0) {
    $rowLogin = mysqli_fetch_assoc($queryLogin);
    if ($password == $rowLogin['password']) {
      $_SESSION['id'] = $rowLogin['id'];
       $_SESSION['name'] = $rowLogin['name'];
      header("location:menu.php");
      die;
    } else {
      header("location:login.php?login=failed");
      die;
    }
  } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
   <section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://yt3.googleusercontent.com/ytc/AIdro_mW9w8G-GlbF0S26welsIJA_P9lGhXQsGLaCG0UlRadDQ=s900-c-k-c0x00ffffff-no-rj"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="" method="POST" >

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h4 fw-bold mb-0">Pusat Pelatihan Kerja</span>
                  </div>
                     <?php if (isset($_GET['login']) && $_GET['login'] == 'failed') : ?>
                      <div class="alert alert-danger alert-dismissible" role="alert">
                        Invalid email or password.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif (isset($_GET['register']) && $_GET['register'] == 'success'): ?>
                      <div class="alert alert-success alert-dismissible" role="alert">
                        Your account has registered successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif ?>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div data-mdb-input-init class="form-outline mb-1">
                    <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />
                    <label class="form-label" for="form2Example17">Email address</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" required/>
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit" name="login">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                      style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 

<script type="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>





