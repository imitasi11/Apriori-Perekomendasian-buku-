  
<?php 

include "../koneksi.php";
$jalan=0;
$number=0;
$satu=1;
$count=1;

$layak = 0;
$tidaklayak = 0;

$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$well="";
$isi=array();
$sql = 'SELECT * FROM nbc_atribut order by id_atribut';
$result = $db->query($sql);
$noatribut=array();
$atribut=array();
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }
$input=array();
for($i=1;$i<=$jml_atribut;$i++){
    if(!empty($_POST[$noatribut[$i]])){
        $input[$i]=1;
    }else{
        $input[$i]=0;
    }
}
$id = $_POST['id'];

    for($i=1;$i<=$jml_atribut;$i++){
        $a=$noatribut[$i];
        $b=$input[$i];
    $update_data = "UPDATE nbc_data SET id_parameter = '$b' WHERE id_responden = '$id' AND id_atribut='$a'";
        $data_result = $db->query($update_data);
    }
    echo $id;

   header('Location: ../testing.php');

?>