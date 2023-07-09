<?php 
$konek=mysqli_connect("localhost" ,"root" , "","db_sewa_mobil");

if (mysqli_connect_errno()) {
    echo "database belum tersambung:". mysqli_connect_error();
}

?>