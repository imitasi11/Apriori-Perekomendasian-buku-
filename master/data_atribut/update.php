  
<?php 

include "../koneksi.php";


$id = $_POST['id'];
$nama = $_POST['nama'];
$bencost = $_POST['bencost'];

$querys_mysql = "UPDATE nbc_atribut SET atribut ='$nama' WHERE id_atribut='$id'";
$resultname= $db->query($querys_mysql);

 header('Location: ../kriteria.php');
?>