  
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
$number = 0;
$numrow = 1;
do{
$id_responden = mt_rand(200, 999);  
$cek_id= "SELECT * FROM nbc_responden where id_responden ='$id_responden' ";
$cek_result = mysqli_query($connect,$cek_id);
$numrow = mysqli_num_rows($cek_result);
}while ($numrow > 0);

$id = $id_responden;
$nama='data'.$id_responden;

    $input_responden = "INSERT INTO nbc_responden VALUES('$id','$nama') ";
    $responden_result = $db->query($input_responden);

    for($i=1;$i<=$jml_atribut;$i++){
        $a=$noatribut[$i];
        $b=$input[$i];
    $input_data = "INSERT INTO nbc_data (id_data,id_responden,id_atribut,id_parameter) VALUES(NULL,'$id','$a','$b') ";
    $data_result = $db->query($input_data);
    }
    echo $nama;

   header('Location: ../testing.php');
?>