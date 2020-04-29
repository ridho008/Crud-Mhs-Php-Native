<?php 
session_start();
if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

// tombol cari ditekan
if(isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman Admin</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
		td img {
			width: 200px;
			height: 200px;
			object-position: top;
			object-fit: cover;
		}

		.loader {
			width: 25px;
			position: absolute;
			z-index: -1;
			left: 400px;
			top: 140px;
			display: none;
		}

		@media print {
			.logout{
				display: none;
			}
		}
	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
  <a class="navbar-brand" href="#">DASIS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav float-right">
      <li class="nav-item">
        <a class="nav-link btn btn-primary text-white mr-1" href="cetak.php" target="_blank">Print</a>
      </li>
      <li class="nav-item">
        <a class="nav-link logout btn btn-primary text-white" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
  </div>
</nav>

<!-- <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a> -->


<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Daftar Mahasiswa</h1>

			<a href="tambah.php" class="btn btn-primary">Tambah Data Mahasiswa</a><br><br>

			<form action="" method="post">
				<div class="form-group">
				<input type="text" class="form-control" name="keyword" size="50" autofocus placeholder="Cari data mahasiswa" autocomplete="off" id="keyword">
				<button type="submit" name="cari" id="tombolCari">Cari</button>
				</div>
				<!-- <img src="img/loading.gif" class="loader"> -->
			</form>
		</div>
	</div>
</div>


<div id="container" class="container">
	<div class="row">
		<div class=".col-md-6 .offset-md-3">
			<table class="table table-hover">
				<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Profile</th>
					<th scope="col">Nama</th>
					<th scope="col">NRP</th>
					<th scope="col">Email</th>
					<th scope="col">Jurusan</th>
					<th scope="col">Aksi</th>
				</tr>
				</thead>

				<tbody>
				<?php $no = 1; foreach( $mahasiswa as $mhs ) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><img src="img/<?= $mhs["gambar"]; ?>" class="gambar"></td>
					<td><?= $mhs["nama"]; ?></td>
					<td><?= $mhs["nrp"]; ?></td>
					<td><?= $mhs["email"]; ?></td>
					<td><?= $mhs["jurusan"]; ?></td>
					<td>
						<a href="ubah.php?id=<?= $mhs['id']; ?>" class="badge badge-success">ubah</a>
						<a href="hapus.php?id=<?= $mhs['id']; ?>" onclick="return confirm('Yakin?')" class="badge badge-danger">hapuss</a>
					</td>
				</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
	<?php if(!$mahasiswa) : ?>
		<p style="color:red;">Data tidak ditemukan</p>
	<?php endif; ?>



<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.0.min.js"></script>
<script src="js/script.js"></script>	
</body>
</html>