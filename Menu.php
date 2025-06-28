<?php
session_start();
ob_start();

include "admin/config/koneksi.php";
include "settingRole.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Project Muhammad Siddiq</title>
  <link rel="shortcut icon" type="image/png" href="https://img.freepik.com/premium-vector/simple-laundry-logo_756483-88.jpg?semt=ais_hybrid&w=740" />
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

  <?php include 'admin/inc/cdnAtas.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"> 
</head>

<body>
  <div class="wrapper">
    
    <!-- Sidebar -->
    <?php include 'admin/inc/sidebar.php'; ?>
    <!-- End Sidebar -->

    <div class="main-panel">

      <!-- Header (Logo + Navbar) -->
      <div class="main-header">
        <div class="main-header-logo">
          <?php include 'admin/inc/logoHeader.php'; ?>
        </div>
        <?php include 'admin/inc/navbar.php'; ?>
      </div>
      <!-- End Header -->

      <!-- Main Content -->
      <div class="container">
        <div class="page-inner">
          <div class="align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <section class="section">

              <!-- Content Routing -->
              <?php
              if (isset($_GET['page'])) {
                  $file = "content/" . $_GET['page'] . ".php";
                  if (file_exists($file)) {
                      include($file);
                  } else {
                      include "content/notfound.php";
                  }
              } else {
                  include "content/dashboard.php";
              }
              ?>
              <!-- End Content -->

            </section>
          </div>
        </div>
      </div>
      <!-- End Main Content -->

      <!-- Footer -->
      <?php include 'admin/inc/footer.php'; ?>
      <!-- End Footer -->

    </div> <!-- End .main-panel -->

    <!-- Optional Custom Template -->
    <?php include 'admin/inc/customTemp.php'; ?>

  </div> <!-- End .wrapper -->

  <!-- Script & CDN -->
  <?php include 'admin/inc/cdnBawah.php'; ?>
</body>
</html>
