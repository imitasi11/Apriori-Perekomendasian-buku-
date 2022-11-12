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
$count2=1;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $noresponden[$count2]=$row['id_responden'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
        $count2=$count2+1;
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
            <section class="panel" style="padding-left: 20px;">
              
              <?php 
              $kategori=array();
              $itemset2=array();
              $kategori2=array();
              for($i=1;$i<=count($data);$i++){
                for($j=1;$j<=count($data[$noresponden[$i]]);$j++){
                  if($data[$noresponden[$i]][$noatribut[$j]]==1){
                    if(!isset($kategori[$noatribut[$j]])){
                     $kategori[$noatribut[$j]]=1;
                    }else{
                      $kategori[$noatribut[$j]]++;
                    }
                  }
                }

                if($i==count($data)){
                  for($x=1;$x<=count($atribut);$x++){
                    if(!isset($kategori[$noatribut[$x]])){
                      $kategori[$noatribut[$x]]=0;
                    }else{
                    $kategori[$noatribut[$x]]=($kategori[$noatribut[$x]]/count($data))*100;
                  }
                  }
                }
              }
             
                $minset1=$_POST['itemset1'];
                $minset2=$_POST['itemset1'];
                $minconfidence=$_POST['confidence'];
                $mc=$minconfidence-0.00001;
                ?>
                minimum support itemset 1 = <?php echo $minset1;?>%<br>
                minimum support itemset 2 = <?php echo $minset2;?>%<br>
                minimum confidence = <?php echo $minconfidence;?>%<br><br>

                <?php
                $target=0;
                $count=1;
                 for($x=1;$x<=count($kategori);$x++){
                    if($kategori[$noatribut[$x]]>=$minset1){
                      $itemset2[$count]=$x;
                      $count=$count+1;
                    }}
                    if(count($itemset2)>0){
                      $target=1;
                    } 
                    ?>
                
               
                <?php if($target>0){?>
                   daftar itemset 1 
                <table border="1">
                  <tr>
                    <td>Nama Kategori</td>
                    <td>Support</td>
                  </tr>
                  <?php  
                  $count=1;
                  for($x=1;$x<=count($kategori);$x++){
                    if($kategori[$noatribut[$x]]>=$minset1){
                      $itemset2[$count]=$noatribut[$x];
                      $count=$count+1;
                      ?>
                    <tr>
                      <td><?php echo $atribut[$noatribut[$x]];?></td>
                      <td><?php echo number_format($kategori[$noatribut[$x]], 2);?>%</td>
                    </tr>
                    <?php
                    } }?>
                </table>
              <?php }
              ?>

<?php
function cek($x,$y,$array){

  if($x==$y){
    return true;
  }
}
function is_exist($x,$y,$array){
  for($i=1;$i<=count($array);$i++){
    if(($array[$i][1]==$x&&$array[$i][2]==$y)||($array[$i][1]==$y&&$array[$i][2]==$x)){
      return true;
    }
  }
}
?>
                <?php
                $count=1;
                for($x=1;$x<=count($itemset2);$x++){
                  for($y=1;$y<=count($itemset2);$y++){
                    if (!is_exist($itemset2[$noatribut[$x]],$itemset2[$noatribut[$y]],$kategori2)) {
                      if(!cek($itemset2[$noatribut[$x]],$itemset2[$noatribut[$y]],$kategori2)){
                      $kategori2[$count][1]=$itemset2[$noatribut[$x]];
                    $kategori2[$count][2]=$itemset2[$noatribut[$y]];
                    $count=$count+1;
                    }
                    }
                 }
                }
                ?>

                <?php
                $kategori3=array();
                for($i=1;$i<=count($kategori2);$i++){
                  for($j=1;$j<=count($data);$j++){
                      if($data[$noresponden[$j]][$kategori2[$i][1]]==1){
                        if($data[$noresponden[$j]][$kategori2[$i][2]]==1){
                          if(!isset($kategori3[$i])){
                           $kategori3[$i]=1;
                          }else{
                            $kategori3[$i]++;
                          }
                        }
                      }
                  }
                }
                
                ?>

                <?php
                for($x=1;$x<=count($kategori2);$x++){
                     if(($kategori3[$x]/count($data)*100)>=$minset2){
                      $target=2;
                    }} ?>

                    <?php if($target>1){?>
                <br><br>
                daftar itemset 2
                <table border="1">
                  <tr>
                    <td>Nama Kategori</td>
                    <td>Support</td>
                  </tr>
                  <?php 
                  $abconfidence=array(); 
                  $lastkategori=array();
                  
                  $count=1;
                  $count2=1;
                  for($x=1;$x<=count($kategori2);$x++){
                     if(($kategori3[$x]/count($data)*100)>=$minset2){
                      $abconfidence[$count2]=$kategori3[$x];
                      $lastkategori[$count2][1]=$kategori2[$x][1];
                      $lastkategori[$count2][2]=$kategori2[$x][2];
                      $count2=$count2+1;

                      ?>
                    <tr>
                      <td><?php echo $atribut[$kategori2[$x][1]]." dan ".$atribut[$kategori2[$x][2]];?></td>
                      <td><?php echo number_format(($kategori3[$x]/count($data))*100,2);?>%</td>
                    </tr>
                    <?php
                    }} ?>
                </table>
                

                  <?php 
                  $hasil=array();
                  $count=1;
                  for($x=1;$x<=count($lastkategori);$x++){
                      for($y=1;$y<=2;$y++){
                     $a=($abconfidence[$x]/(($kategori[$lastkategori[$x][$y]]*count($data))/100))*100;
                     $b=($abconfidence[$x]/count($data))*100;
                      
                        $target=3;
                        $hasil[$count][1]=$atribut[$lastkategori[$x][$y]];
                        $hasil[$count][2]=$atribut[$lastkategori[$x][1]]." dan ".$atribut[$lastkategori[$x][2]];
                        $hasil[$count][3]=$a;
                        $hasil[$count][4]=$atribut[$lastkategori[$x][2]];
                        $hasil[$count][5]=$kategori[$noatribut[$lastkategori[$x][$y]]];
                        $hasil[$count][6]=$b;
                        $hasil[$count][7]=$abconfidence[$x];
                        $hasil[$count][8]=($kategori[$lastkategori[$x][$y]]*count($data))/100;

                        $count=$count+1;
                      
                    }}
?>
               
               <?php if($target>2){?>
                <br><br>
                Tabel aturan asosiasi
                <table border="1">
                  <tr>
                    <td>Kategori</td>
                    <td>Daftar Itemset2</td>
                    <td>Confidence</td>
                  </tr>
                  <?php 
                  for($i=1;$i<=count($hasil);$i++){
                    ?>
                    <tr>
                      <td><?php echo $hasil[$i][1];?></td>
                      <td><?php echo $hasil[$i][2];?></td>
                      <td><?php echo number_format($hasil[$i][3], 2);?>%</td>
                    </tr>
                      <?php
                  }
                  ?>
                </table>


                <br><br>
                Tabel aturan asosiasi2
                <table border="1">
                  <tr>
                    <td width="400px;">Aturan</td>
                    <td colspan="2" align="center" style="text-align:center">Confidance</td>
                  </tr>
                  <?php 
                  for($i=1;$i<=count($hasil);$i++){
                    ?>
                    <tr>
                      <td>Jika meminjam kategori buku <?php echo $hasil[$i][1];?>, maka akan meminjam kategori <?php echo $hasil[$i][4];?></td>
                      <td><?php echo $hasil[$i][7];?>/<?php echo $hasil[$i][8];?></td>
                      <td><?php echo number_format($hasil[$i][3], 2);?>%</td>
                    </tr>
                      <?php
                  }
                  ?>
                </table>


                <br><br>
                Hasil Akhir
                <table border="1" width="400px;">
                <?php 
                $countno=1;
                  for($i=1;$i<=count($hasil);$i++){
                    if($hasil[$i][3]>=$mc){
                    ?>
                    <tr>
                      <td><?php echo $countno?></td>
                      <td align="justify">Dari keseluruhan data transaksi, Peminjam yang meminjam kategori Buku <?php echo $hasil[$i][1];?>, kemungkinan <?php echo number_format($hasil[$i][6],2);?>% juga akan meminjam Buku <?php echo $hasil[$i][4];?> dengan tingkat hubungan sebesar <?php echo number_format($hasil[$i][3],2);?>%</td>
                    </tr>
                      <?php
                      $countno=$countno+1;
                  }}
                  ?>
                  </table>
               <?php }} ?>

               <br><br>
               <?php if($target==3){

               }
               if($target==2){
                ?>Tidak ada data yang sesuai dengan minimum confidence yang diinputkan<?php
               }
               if($target==1){
                ?>Tidak ada data yang sesuai dengan minimum itemset2 yang diinputkan<?php
               }
               if($target==0){
                ?>Tidak ada data yang sesuai dengan minimum itemset1 yang diinputkan<?php
               }?>
               <br><br>
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
