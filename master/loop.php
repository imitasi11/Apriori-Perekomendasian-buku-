<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';
for($i=1;$i<=253;$i++){
$nama='data'.$i;
mysqli_query($connect,"INSERT INTO nbc_responden VALUES('$i','$nama')");
}

?>
