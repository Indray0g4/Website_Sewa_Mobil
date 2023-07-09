<?php 
include 'koneksi.php';
$sql_tabel_sewa="SELECT
                  tb_sewa.id_sewa,
                  tb_sewa.no_sewa,
                  tb_sewa.tgl_sewa,
                  tb_sewa.id_mobil,
                  tb_sewa.jumlah_sewa,
                  tb_sewa.nama_penyewa,
                  tb_sewa.keterangan,
                  tb_mobil.nama_pemilik_mobil,
                  tb_mobil.merk_mobil,
                  tb_mobil.jenis_transmisi,
                  Sum(tb_mobil.harga_sewa * tb_sewa.jumlah_sewa) AS sub_total,
                  tb_mobil.harga_sewa
FROM
tb_sewa
INNER JOIN tb_mobil ON tb_sewa.id_mobil = tb_mobil.id_mobil
GROUP BY
tb_sewa.no_sewa";
$query_tabel_sewa=mysqli_query($konek, $sql_tabel_sewa);
$sql_tabel2="SELECT * FROM tb_mobil";
$query_tabel2=mysqli_query($konek, $sql_tabel2);
// Tambah Data Sewa
if (isset($_POST['simpan_data_sewa']) ) {
  $nama_penyewa=$_POST['nama_penyewa'];
  $no_sewa=$_POST['no_sewa'];
  $tgl_sewa=$_POST['tgl_sewa'];
  $id_mobil=$_POST['id_mobil'];
  $jumlah_sewa=$_POST['jumlah_sewa'];
  $keterangan=$_POST['keterangan'];
  $sql_tambah_sewa="INSERT INTO tb_sewa(id_sewa, no_sewa, tgl_sewa, id_mobil, jumlah_sewa, nama_penyewa, Keterangan) VALUES ('', '$no_sewa', '$tgl_sewa', '$id_mobil', '$jumlah_sewa', '$nama_penyewa', '$keterangan')";
  $query_tambah_sewa=mysqli_query($konek, $sql_tambah_sewa);
  if ($query_tambah_sewa) {
    echo "
    <script>
      alert('Data Berhasil Ditambahkan');
      document.location='data_sewa.php?status=sukses';
    </script>";
  }else{
    echo "
    <script>
      alert('Data Tidak dapat Ditambahkan?status=gagal');
      document.location='data_sewa.php';
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
      Data Sewa
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Data Sewa</li>
        </ol>
      </nav>
      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus"></i> Tambah Data Sewa
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
            <th scope="col">No Sewa</th>
            <th scope="col">Nama Penyewa</th>
            <th scope="col">Tanggal Sewa</th>
            <th scope="col">Total</th>            
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
         <?php $no=1; ?>
         <?php foreach ($query_tabel_sewa as $sewa) {?>
         <tr>
            <th scope="row"><?= $no; ?></th>
            <td><?= $sewa["no_sewa"]; ?></td>
            <td><?= $sewa["nama_penyewa"]; ?></td>
            <td><?= $sewa["tgl_sewa"]; ?></td>
            <td>Rp. <?= number_format($sewa["sub_total"]); ?></td>
            <td><?= $sewa["keterangan"]; ?></td>
            <td>
              <a href="detail_sewa.php?no_sewa=<?= $sewa['no_sewa']; ?>&&nama_penyewa=<?= $sewa['nama_penyewa']; ?>&&tgl_sewa=<?= $sewa['tgl_sewa']; ?>" class="btn btn-outline-success"><i class="fas fa-search"></i></a>  
              <a href="hapus_sewa.php?id_sewa=<?= $sewa['id_sewa']; ?>" class="btn btn-outline-danger" onclick="return confirm('ingn menghapus <?= $sewa["no_sewa"]; ?> ')"><i class="fas fa-times"></i></a>  
            </td>
          </tr>
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
            <input type="number" class="form-control" id="inputEmail3" name="no_sewa" placeholder="Masukkan Judul Buku" name="judul_buku" value="<?= rand(100,999); ?>" readonly autocomplete="off" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama_penyewa" class="col-sm-3 col-form-label">Nama Penyewa</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_penyewa" placeholder="Masukkan Nama Penyewa" name="nama_penyewa" autocomplete="off" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="tgl_sewa" class="col-sm-3 col-form-label">Tanggal Sewa</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="tgl_sewa" placeholder="Masukkan Judul Buku" name="tgl_sewa" autocomplete="off" required>
          </div>
        </div>                
        <div class="form-group row">
          <label for="merk_mobil" class="col-sm-3 col-form-label">Merk Mobil</label>
          <div class="col-sm-9">
            <select id="merk_mobil" class="form-control" name="id_mobil" required>
              <?php foreach ($query_tabel2 as $merk) { ?>
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
          <input class="btn btn-outline-primary" type="submit" name="simpan_data_sewa" value="Simpan">
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