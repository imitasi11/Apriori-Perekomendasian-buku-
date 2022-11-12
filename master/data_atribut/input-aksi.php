  
<?php 

include "../koneksi.php";

$nama = $_POST['nama'];

$id_atribut=rand(1,100);
$cek_id= "SELECT * FROM nbc_atribut where id_atribut ='$id_atribut' ";
$cek_result = mysqli_query($connect,$cek_id);
$numrow = mysqli_num_rows($cek_result);

while($numrow > 0){
	$id_atribut=0;
	$id_atribut=rand(1,100);
	$cek_id= "SELECT * FROM nbc_atribut where id_atribut ='$id_atribut' ";
	$cek_result = mysqli_query($connect,$cek_id);
	$numrow = mysqli_num_rows($cek_result);
}

	$input_atribut = "INSERT INTO nbc_atribut VALUES('$id_atribut','$nama') ";
	$atribut_result = $db->query($input_atribut);
	$responden="SELECT * from nbc_responden";
	$responden_result= $db->query($responden);
	foreach ($responden_result as $row) {
		$a=$row['id_responden'];
		$query_mysql = "INSERT INTO nbc_data VALUES(NULL,'$a',$id_atribut,'0')";
		$result= $db->query($query_mysql);
	}
	

 header('Location: ../kriteria.php');
 // delete

?>