<?php 
include '../koneksi.php';
$id = $_GET['id'];
$delete_data= "DELETE FROM nbc_data where id_atribut ='$id' ";
$data_result = $db->query($delete_data);
$delete_atr= "DELETE FROM nbc_atribut where id_atribut ='$id' ";
$atr_result = $db->query($delete_atr);
header("location:../kriteria.php");
?>