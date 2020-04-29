<?php
session_start();
if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan idnya
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if(isset($_POST["submit"]) ) {
	
	// apakah data berhasil diubah / tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah');
				document.location.href = 'index.php';
			</script>
		";
	}


}


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ubah Data Mahasiswa</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Ubah Data Mahasiswa</h1>
		</div>
	</div>
</div>
	
<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $mhs['id']; ?>">
				<input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>" class="form-control">
					</div>
						
					<div class="form-group">
						<label for="nrp">NRP</label>
						<input type="number" name="nrp" id="nrp" value="<?= $mhs["nrp"]; ?>" class="form-control">
					</div>
						
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?= $mhs["email"]; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="jurusan">Jurusan</label>
						<input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>" class="form-control">
					</div>	
					<div class="form-group">
						<label for="gambar">Gambar</label><br>
						<img src="img/<?= $mhs["gambar"]; ?>" width="100"><br>
						<input type="file" name="gambar" id="gambar" class="form-control-file">
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
			</form>
		</div>
	</div>
</div>
	
<script src="js/bootstrap.min.js"></script>
</body>
</html>