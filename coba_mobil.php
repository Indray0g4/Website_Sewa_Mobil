<?php 
include 'koneksi.php';
$tabel_mobil="SELECT * FROM tb_mobil";
$query_tabel=mysqli_query($konek, $tabel_mobil);
// tambah Data Mobil
if (isset($_POST['simpan_data'])) {
  $nama_pemilik_mobil=$_POST['nama_pemilik_mobil'];
  $merk_mobil=$_POST['merk_mobil'];
  $jenis_transmisi=$_POST['jenis_transmisi'];
  $jumlah_mobil=$_POST['jumlah_mobil'];
  $harga_sewa=$_POST['harga_sewa'];
  $sql_simpan_mobil="INSERT INTO tb_mobil(id_mobil, nama_pemilik_mobil, merk_mobil, jenis_transmisi, jumlah_mobil, harga_sewa) VALUES ('', '$nama_pemilik_mobil', '$merk_mobil', '$jenis_transmisi', '$jumlah_mobil', '$harga_sewa')";
  $query_simpan_mobil=mysqli_query($konek, $sql_simpan_mobil);
  if ($query_simpan_mobil) {
    echo "
    <script>
      alert('Data Berhasil Ditambahkan');
      document.location='data_mobil.php';
    </script>";
  }else{
    echo "
    <script>
      alert('Data Tidak dapat Ditambahkan');
      document.location='data_mobil.php';
    </script>";
  }       
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Data Mobil | Aplikasi Sewa Mobil</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="fontawesome/css/all.min.css" rel="stylesheet">  
</head>
<body>
	<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">RENTAL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="data_mobil.php">Data Mobil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="data_sewa.php">Data Sewa Mobil</a>
      </li>  
    </ul>
    <form class="form-inline my-2 my-lg-0">

    </form>
  </div>
</nav>
<div class="container mt-5">
  <!-- Card -->
  <div class="card">
    <div class="card-header text-white bg-primary">
      Data Mobil
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text">Data Mobil</p>
      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#tambah_mobil">
      <i class="fas fa-plus"></i> Tambah Data Mobil
      </button>
    </div>
  </div>
  <!-- Card 2 -->
  <div class="card mt-4">
    <div class="card-body">
      <!-- tabel -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Mobil</th>
            <th scope="col">Merk Mobil</th>
            <th scope="col">jenis Mobil</th>
            <th scope="col">Jumlah Mobil</th>            
            <th scope="col">Harga Sewa</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($query_tabel as $mobil) { ?>
          <tr>
            <th scope="row"><?= $no; ?></th>
            <td><?= $mobil["nama_pemilik_mobil"]; ?></td>
            <td><?= $mobil["merk_mobil"]; ?></td>
            <td><?= $mobil["jenis_transmisi"]; ?></td>
            <td><?= $mobil["jumlah_mobil"]; ?></td>
            <td><?= number_format($mobil["harga_sewa"]); ?></td>
            <td>
              <!-- ubah -->
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#ubah_mobil">
              <i class="fas fa-plus"></i> Ubah Data Mobil
              </button>              
              <a href="ubah_mobil.php?id_mobil=<?= $mobil['id_mobil']; ?>" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>  
              <a href="hapus_mobil.php" class="btn btn-outline-danger"><i class="fas fa-times"></i></a>  
            </td>
          </tr>
          <?php $no++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambah_mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- Form -->
      <form action="#" method="post">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Mobil</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Nama Mobil" name="nama_pemilik_mobil" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Merk Mobil</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Merk Mobil" name="merk_mobil" autocomplete="off">
          </div>
        </div>        
        <div class="form-group row">
          <label for="jenis_transmisi" class="col-sm-3 col-form-label">Jenis Mobil</label>
          <div class="col-sm-9">
            <select id="jenis_transmisi" class="form-control" name="jenis_transmisi">
          <option value="manual" selected>manual</option>
          <option value="matic">matic</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-3 col-form-label">Jumlah Mobil</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="inputPassword3" placeholder="Masukkan Jumlah Mobil" name="jumlah_mobil" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-3 col-form-label">Harga Sewa</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="inputPassword3" placeholder="Masukkan Harga Sewa" name="harga_sewa" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-outline-primary" type="submit" name="simpan_data" value="simpan">
<!--           <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button> -->        
        </div>        
      </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ubah_mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- Form -->
      <form action="#" method="post">
        <div class="form-group row">
          <input type="text" class="form-control" id="id_mobil" placeholder="" name="id_mobil" autocomplete="off">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Mobil</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Nama Mobil" name="nama_pemilik_mobil" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Merk Mobil</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Merk Mobil" name="merk_mobil" autocomplete="off">
          </div>
        </div>        
        <div class="form-group row">
          <label for="jenis_transmisi" class="col-sm-3 col-form-label">Jenis Mobil</label>
          <div class="col-sm-9">
            <select id="jenis_transmisi" class="form-control" name="jenis_transmisi">
          <option value="manual" selected>manual</option>
          <option value="matic">matic</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-3 col-form-label">Jumlah Mobil</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="inputPassword3" placeholder="Masukkan Jumlah Mobil" name="jumlah_mobil" autocomplete="off">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-3 col-form-label">Harga Sewa</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="inputPassword3" placeholder="Masukkan Harga Sewa" name="harga_sewa" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-outline-primary" type="submit" name="simpan_data" value="simpan">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>        
        </div>        
      </form>
      </div>
      
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