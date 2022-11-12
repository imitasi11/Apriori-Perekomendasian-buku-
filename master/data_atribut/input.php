<!DOCTYPE html>
<html>
<head>

<?php
include "../koneksi.php";
?>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Perekomendasian BUKU</title>
  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />
<!--header start-->
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo">Perekomendasian  <span class="lite">BUKU</span></a>
      <!--logo end-->
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="omah.php">
                          <i class="icon_desktop"></i>
                            <span>Home</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="kriteria.php">
                          <i class="icon_document_alt"></i>
                            <span>Kategori</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="testing.php">
                          <i class="icon_document_alt"></i>
                            <span>Data Transaksi</span>
                      </a>
          </li>
          <li class="">
            <a class="" href="map.php">
                          <i class="icon_house_alt"></i>
                            <span>Perhitungan</span>
                      </a>
          </li>
                
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- nicescroll -->
  <script src="../js/jquery.scrollTo.min.js"></script>
  <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="../js/scripts.js"></script>
<!--header start-->
 
    <section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Input Kategori</h3>
            <section class="panel" style="padding-left: 400px;padding-top: 34px;">
              <div style="width: 60%; border-style: solid;padding: 40px; ">
  <form action="input-aksi.php" method="post" enctype="multipart/form-data">
  <table>
  Nama Kategori
      <input type="text" class="form-control" name="nama" value=""><br>
  
  <tr>
    <td><input style="margin-top: 30px;" type="submit" class="btn btn-primary" name="upload" value="Upload"></td>
  </tr>
  </table>
<script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- nicescroll -->
  <script src="../js/jquery.scrollTo.min.js"></script>
  <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="../js/scripts.js"></script>

</section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    
  </section>
  


</body>

</html>