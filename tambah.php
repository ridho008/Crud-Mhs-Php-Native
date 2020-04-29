<?php
session_start();
if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

if(isset($_POST["submit"]) ) {

	// apakah data berhasil ditambahkan / tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan');
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
	<title>Tambah Data Mahasiswa</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-11 text-center">
			<h1>Tambah Data Mahasiswa</h1>
		</div>
		<div class="col-md-5 offset-md-3">
			
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" name="nama" id="nama" class="form-control">
				</div>
				<div class="form-group">
					<label for="nrp">NRP</label>
					<input type="number" name="nrp" id="nrp" class="form-control">
				</div>	
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control">
				</div>
					
				<div class="form-group">
					<label for="jurusan">Jurusan</label>
					<input type="text" name="jurusan" id="jurusan" class="form-control">
				</div>

				<div class="form-group">
					<label for="gambar">Gambar</label>
					<input type="file" name="gambar" id="gambar" class="form-control-file">
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>	
			</form>
		</div>
	</div>
</div>
	
<script src="js/bootstrap.min.js"></script>
</body>
</html>