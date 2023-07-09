<?php 
include "koneksi.php";
$id_mobil = $_GET['id_mobil'];
$sql_hapus="DELETE FROM tb_mobil WHERE id_mobil='$id_mobil'";
$query_hapus=mysqli_query($konek, $sql_hapus)or die(mysql_error());

header("Location:data_mobil.php?pesan=hapus");
?>