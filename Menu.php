<?php
session_start();
ob_start();
include "admin/config/koneksi.php";
include 'settingRole.php'

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Project Muhammad Siddiq</title>
    <link rel="shortcut icon" type="image/png" href="https://img.freepik.com/premium-vector/simple-laundry-logo_756483-88.jpg?semt=ais_hybrid&w=740" />
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <?php include 'admin/inc/cdnAtas.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"> 
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
       <?php include 'admin/inc/sidebar.php' ?>
      <!-- End Sidebar -->
      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
      <!-- Logo Header -->
           <?php include 'admin/inc/logoHeader.php' ?>
      <!-- End Logo Header -->
          </div>
      <!-- Navbar Header -->
          <?php include 'admin/inc/navbar.php'?>
      <!-- End Navbar -->
        </div>
       <!-- start isi content -->
        <div class="container">
          <div class="page-inner">
            <div class=" align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <!-- isi disini contentnya -->
              <section class="section">
            <?php
            if (isset($_GET['page'])) {
                //jika file ada
                if (file_exists("content/" . $_GET['page'] . ".php")) {
                    include("content/" . $_GET['page'] . ".php");
                } else {
                    include "content/notfound.php";
                }
            } else {
                include 'content/dashboard.php';
            }
            ?>

      <!-- batas sampe sini -->
            </div>
          </div>
        </div>
      <!-- End isi content -->
      <!-- start footer -->
     <?php include 'admin/inc/footer.php' ?>
      </div>

      <!-- Custom template | don't include it in your project! -->
    <?php include 'admin/inc/customTemp.php' ?>
      <!-- End Custom template -->
    </div>
    <?php include 'admin/inc/cdnBawah.php' ?>
  </body>
</html>
