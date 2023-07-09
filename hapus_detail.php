<?php 
include "koneksi.php";
$id_sewa = $_GET['id_sewa'];
$no_sewa=$_GET['no_sewa'];
$nama_penyewa=$_GET['nama_penyewa'];
$tgl_sewa=$_GET['tgl_sewa'];
$sql_hapus="DELETE FROM tb_sewa WHERE id_sewa='$id_sewa'";
$query_hapus=mysqli_query($konek, $sql_hapus)or die(mysql_error());

header("Location:data_sewa.php?no_sewa=$no_sewa&&nama_penyewa=$nama_penyewa&&tgl_sewa=$tgl_sewa?pesan=hapus");
?>