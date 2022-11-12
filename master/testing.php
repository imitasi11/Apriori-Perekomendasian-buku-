<!DOCTYPE html>
<html lang="en">

<head>
 
<script src="jquery.js"></script> 
    
   
<?php 
$nomer=1;
$jml_atribut=0;
$isi=array();
include "koneksi.php";

$count=1;

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

//-- query untuk mendapatkan semua data training di tabel nbc_responden dan nbc_data
$sql = 'SELECT * FROM nbc_data a JOIN nbc_responden b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}

?>
</head>

<body>
       
  <!-- container section start -->
  <section id="container" class="">
    
<?php include('linkb.php'); ?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                TABEL DATA Transaksi<br>
                <p align="right">
               <a class="btn btn-success" href="data_kelola/input.php">Tambah Data</a>
              </p>
              </header>
              <table class="table table-striped">
                 
                <thead>
                  <tr>
                    <th>Responden</th>
                    <?php 
                        //-- menampilkan header table
                        for($i=1;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
                        ?>
                        <th colspan="2" align="center" style="text-align:center">Aksi</th>
                  </tr>
                </thead>
                   <tbody>
                        <?php
                        
                        //-- menampilkan data secara literal
                        foreach($data as $id_responden=>$dt_atribut){
                           
                            echo "<tr><td>{$responden[$id_responden]}</td>";
                            for($i=1;$i<=$jml_atribut;$i++){ 
                                echo "<td>{$dt_atribut[$noatribut[$i]]}</td>";
                            }
                        ?>  <td><a class="btn btn-primary" href="data_kelola/edit.php?id=<?php echo $id_responden; ?>"  onclick="return confirm('Edit data?')">edit</a></td>
                            <td><a class="btn btn-danger" href="data_kelola/delete.php?id=<?php echo $id_responden; ?>"  onclick="return confirm('Hapus data?')">delete</a></td></tr> <?php

                            }

                        ?>
                  </tr>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
  </section>
  


</body>

</html>
