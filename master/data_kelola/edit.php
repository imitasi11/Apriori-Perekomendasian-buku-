<!DOCTYPE html>
<html>
<head>

<?php
include "../koneksi.php";
$count=1;
$jml_atribut=0;

$sql = 'SELECT * FROM nbc_atribut ORDER BY id_atribut' ;
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
$noatribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }
    $id=0;
    $id=$_GET['id'];
$sql = "SELECT * FROM nbc_data WHERE id_responden='$id' ";
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $data[$row['id_atribut']]=$row['id_parameter'];
}
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
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Edit Data</h3>
            <section class="panel" style="padding-left: 34px;padding-top: 34px;">
  
<form action="update.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id;?>">
                <div align="left" valign="top">
                    <?php
                    for($i=1;$i<=$jml_atribut;$i++){
                        $numba=$i-1;
                    if ($numba == 0) {
                    ?><div style="display: inline-block;width: 100px;height: 100px;margin-left: 50px;vertical-align: top;">
                    <?php }elseif ($numba % 5 == 0) {
                    ?></div><div style="display: inline-block;width: 100;height: 100px;margin-left: 50px;margin-bottom: 150px;vertical-align: top;">
                    <?php } ?>

                                <div class="form-group" style="margin-right: 10px;">
                                <label>
                                    <input type="checkbox" name="<?php echo $noatribut[$i]?>" id="optionsRadios1" value="y" <?php if($data[$noatribut[$i]]==1){
                                      echo "checked";

                                    }?> >
                                    <?php echo $atribut[$noatribut[$i]]?>
                                    
                                </label>
                                </div>
                    <?php }?>
                </div>
        </div>
         <div class="form-group" style="margin-left: 40px;padding-bottom: 20px;">
                        <button type="submit" name="upload" value="Upload" class="btn btn-primary">Update</button>
                     </div>
      </form>



  
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