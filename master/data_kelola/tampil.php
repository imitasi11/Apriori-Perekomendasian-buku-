<script src="../jquery.js"></script> 
    
    <script> 
    $(function(){
      $("#linkb").load("../linkb.html"); 
    });
    </script> 
    <?php
$layak = 0;
$tidaklayak = 0;
$nomor = 1;
$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$isi=array();
include "../koneksi.php";
$count=1;


$sql = 'SELECT * FROM tb_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $noatribut[$count]=$row['id_atribut'];
    $count=$count+1;
    }
?>

<?php
//-- query untuk mendapatkan semua data atribut di tabel tb_atribut
$sql = 'SELECT * FROM tb_parameter ORDER BY id_atribut,id_parameter';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$parameter=array();
$id_atribut=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_atribut!=$row['id_atribut']){
        $parameter[$row['id_atribut']]=array();
        $id_atribut=$row['id_atribut'];
    }
    $parameter[$row['id_atribut']][$row['nilai']]=$row['parameter'];
}

?>

<?php

//-- query untuk mendapatkan semua data training di tabel tb_responden dan tb_data
$sql = 'SELECT * FROM tb_data_test a JOIN tb_responden_test b USING(id_responden) ORDER BY b.id_responden';
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
//print_r($data);
//-- menampilkan data training dalam bentuk tabel

?>

              <header class="panel-heading">
                TABEL DATA TESTING
                <div align ="right"style="margin-right: 0px;">
                    <a class="btn btn-primary" target="_blank" style="margin-right: 10px;" href="printpre.php">Print Preview</a>
                <a class="btn btn-danger" onclick="return confirm('Hapus Semua data?')" href="data_testing/deleteall.php">Hapus Semua</a>
            </div>
              </header>
              <div style="height: 300px;overflow-y : auto;">
              <table class="table table-striped">

                 
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Responden</th>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$i]}</th>";
                        }
                        ?>
                        <th colspan="2" style="text-align:center">Aksi</th>
                  </tr>
                </thead>
                   <tbody>

                        <?php

                        //-- menampilkan data secara literal
                        foreach($data as $id_responden=>$dt_atribut){
                            echo "<tr><td>$nomor</td>
                            <td>{$responden[$id_responden]}</td>";
                            for($i=2;$i<=$jml_atribut;$i++){ 
                                echo "<td>{$parameter[$noatribut[$i]][$dt_atribut[$noatribut[$i]]]}</td>";
                            }
                        ?>  <td><a class="btn btn-primary" href="data_testing/edit.php?id=<?php echo $id_responden; ?>">edit</a></td>
                            <td><a class="btn btn-danger" href="data_testing/delete.php?id=<?php echo $id_responden; ?>">delete</a></td></tr> <?php
                            $nomor=$nomor+1;
                            }

                        ?>
                 </tbody>
              </table>
           </div>