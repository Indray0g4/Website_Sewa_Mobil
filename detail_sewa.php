<?php 
include 'koneksi.php';
$no_sewa=$_GET['no_sewa'];
$nama_penyewa=$_GET['nama_penyewa'];
$tgl_sewa=$_GET['tgl_sewa'];
$sql_detail="SELECT * FROM tb_sewa INNER JOIN tb_mobil ON tb_mobil.id_mobil = tb_sewa.id_mobil WHERE no_sewa = '$no_sewa'";
$query_detail=mysqli_query($konek, $sql_detail);
// Tambah Detail
if (isset($_POST['simpan_detai'])) {
  $id_mobil=$_POST['id_mobil'];
  $jumlah_sewa=$_POST['jumlah_sewa'];
  $keterangan=$_POST['keterangan'];
  $sql_tambah_detail="INSERT INTO tb_sewa(id_sewa, no_sewa, tgl_sewa, id_mobil, jumlah_sewa, nama_penyewa, Keterangan) VALUES ('', '$no_sewa', '$tgl_sewa', '$id_mobil', '$jumlah_sewa', '$nama_penyewa', '$keterangan')";
  $query_tambah_detail=mysqli_query($konek, $sql_tambah_detail);
  if ($query_tambah_detail) {
    echo "
    <script>
      alert('Data Berhasil Ditambahkan');
      document.location='detail_sewa.php?no_sewa=$no_sewa&&nama_penyewa=$nama_penyewa&&tgl_sewa=$tgl_sewa?status=sukses';
    </script>";
  }else{
    echo "
    <script>
      alert('Data Tidak dapat Ditambahkan?no_sewa=$no_sewa&&nama_penyewa=$nama_penyewa&&tgl_sewa=$tgl_sewa?status=gagal');
      document.location='detail_sewa.php';
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
	<title>Data Sewa Mobil | Aplikasi Sewa Mobil</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="fontawesome/css/all.min.css" rel="stylesheet"> 
</head>
<body style="background-color: aqua;">
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
      <li class="nav-item">
        <a class="nav-link" href="data_mobil.php">Data Mobil</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link disabled" href="data_sewa.php">Data Sewa Mobil</a>
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
      Data Detail Sewa
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page"><a href="data_sewa.php" class="text-decoration-none">Data Sewa</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Sewa</li>
        </ol>
      </nav>
      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus"></i> Tambah Data Sewa Mobil
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
            <th scope="col">Merk Mobil</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($query_detail as $detail) {?>
          <tr>
            <td scope="row"><?= $no; ?></td>
            <td><?= $detail["merk_mobil"]; ?></td>
            <td><?= $detail["jumlah_sewa"]; ?></td>
            <td><?= number_format($detail["harga_sewa"]); ?></td>
            <td><?= $detail["keterangan"] ?></td>
            <td>
              <a href="hapus_detail.php?id_sewa=<?= $detail['id_sewa'];?>" class="btn btn-outline-danger" onclick="return confirm('Hapus ?')"><i class="fas fa-times"></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sewa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- Form -->
      <form action="#" method="post">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor Sewa</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="inputEmail3" name="no_sewa" placeholder="Masukkan Judul Buku" name="no_sewa" value="<?= $no_sewa; ?>" readonly autocomplete="off" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Sewa</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="inputEmail3" name="tgl_sewa" placeholder="Masukkan Judul Buku" name="tgl_sewa" value="<?= $tgl_sewa; ?>" readonly autocomplete="off" required>
          </div>
        </div>         
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Penyewa</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputEmail3" name="nama_penyewa" placeholder="Masukkan Judul Buku" name="no_sewa" value="<?= $nama_penyewa; ?>" readonly autocomplete="off" required>
          </div>
        </div>                                                                  
        <div class="form-group row">
          <label for="merk_mobil" class="col-sm-3 col-form-label">Merk Mobil</label>
          <div class="col-sm-9">
            <select id="merk_mobil" class="form-control" name="id_mobil" required>
              <?php 
              $sql_tabel2="SELECT * FROM tb_mobil";
              $query_tabel2=mysqli_query($konek, $sql_tabel2);
              foreach ($query_tabel2 as $merk) { ?>
                <option value="<?= $merk['id_mobil']; ?>"><?= $merk["merk_mobil"]; ?> Rp.<?= number_format($merk["harga_sewa"]); ?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="jumlah_sewa" class="col-sm-3 col-form-label">Jumlah Sewa</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" id="jumlah_sewa" placeholder="Masukkan Jumlah Sewa" name="jumlah_sewa" autocomplete="off" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="jumlah_sewa" class="col-sm-3 col-form-label">Keterangan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="jumlah_sewa" value="Pinjam" placeholder="Masukkaan Keterangan" name="keterangan" readonly autocomplete="off" required>
          </div>
        </div>                           
        <div class="modal-footer">
          <input class="btn btn-outline-primary" type="submit" name="simpan_detai" value="Simpan">
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