<?php 
include 'koneksi.php';
$id_mobil=$_GET['id_mobil'];
$sql_id_mobil="SELECT * FROM tb_mobil WHERE id_mobil='$id_mobil'";
$query_id_mobil=mysqli_query($konek, $sql_id_mobil);
$data_mobil=mysqli_fetch_array($query_id_mobil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ubah Data Mobl | Aplikasi Sewa Mobil</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link href="fontawesome/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: aqua;">
<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="text-decoration-none" href="data_mobil.php">Data Mobil</a></li>
      <li class="breadcrumb-item active" aria-current="page">Ubah Data Mobil</li>
    </ol>
  </nav>
	<div class="card border-warning mt-4">
	  <div class="card-header bg-warning">
	    Ubah Data Mobil
	  </div>
	<div class="card-body">
	<!-- form -->
	    <form action="data_mobil.php" method="POST" role="form">
	        <div class="form-group row">
	          <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
	          <div class="col-sm-9">
	            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan id Mobil" name="id_mobil" value="<?= $data_mobil['id_mobil']; ?>" autocomplete="off" hidden>
	          </div>
	        </div>
	        <div class="form-group row">
	          <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Mobil</label>
	          <div class="col-sm-9">
	            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan nama Mobil" name="nama_pemilik_mobil" value="<?= $data_mobil['nama_pemilik_mobil']; ?>" autocomplete="off">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label for="inputEmail3" class="col-sm-3 col-form-label">Merk Mobil</label>
	          <div class="col-sm-9">
	            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan merk Mobil" name="merk_mobil" value="<?= $data_mobil['merk_mobil']; ?>" autocomplete="off">
	          </div>
	        </div>		        
	        <div class="form-group row">
	          <label for="jenis_transmisi" class="col-sm-3 col-form-label">Jenis Mobil</label>
	          <div class="col-sm-9">
	            <select id="jenis_transmisi" class="form-control" name="jenis_transmisi">
	          <option value="Manual" <?php if ($data_mobil['jenis_transmisi']=='Manual') {echo 'selected';} ?>>Manual</option>
	          <option value="Matic" <?php if ($data_mobil['jenis_transmisi']=='Matic') {echo 'selected';} ?>>Matic</option>
	            </select>
	          </div>
	        </div>
	        <div class="form-group row">
	          <label for="inputPassword3" class="col-sm-3 col-form-label">jumlah Mobil</label>
	          <div class="col-sm-9">
	            <input type="number" class="form-control" id="inputPassword3" placeholder="Masukkan jumlah Mobil" name="jumlah_mobil" autocomplete="off" value="<?= $data_mobil['jumlah_mobil']; ?>">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label for="inputPassword3" class="col-sm-3 col-form-label">Harga Sewa</label>
	          <div class="col-sm-9">
	            <input type="number" class="form-control" id="inputPassword3" placeholder="Masukkan Harga Sewa" name="harga_sewa" autocomplete="off" value="<?= $data_mobil['harga_sewa']; ?>">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
	          <div class="col-sm-9">
	            <button name="ubah_data" value="tekan" type="submit" class="btn btn-block btn-warning">Ubah</button>
	          </div>
	        </div>
	    </form>        
	  </div>
	</div>    
</div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>	
</body>
</html>