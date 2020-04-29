<?php 
session_start();
require 'functions.php';
//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan idnya
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id'");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}
}

if(isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}


if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	// cek username
	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if( mysqli_num_rows($result) === 1 ) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"]) ) {
			// cek session
			$_SESSION["login"] = true;

			// cek rememberme
			if(isset($_POST["remember"]) ) {
				// buat cookie

				setcookie('id', $row["id"], time() + 60 );
				setcookie('key', hash('sha256', $row["username"]), time() + 60 );
			}

			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
		.container {
			margin: 140px auto;
		}

		.col-md-4 {
			background: #eee;
			padding: 20px;
			border-radius: 20px;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<h1 class="text-center">Halaman Login</h1>
		<?php if(isset($error) ) : ?>
			<div class="alert alert-danger" role="alert">
			  Username/Passworrd Anda Salah!
			</div>
		<?php endif; ?>
			<form action="" method="post">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" id="username">
				</div>
					<label for="password">Password</label>
					<input type="password" class="form-control"  name="password" id="password">
				<div class="form-group form-check">
					<input type="checkbox" name="remember" id="remember" class="form-check-input">
					<label for="remember" class="form-check-label">Remember Me</label>
				</div>
				
					<button type="submit" name="login" class="btn btn-primary">Login</button>
				</li>
			</ul>
			</form>
		</div>
	</div>
</div>






<script src="js/bootstrap.min.js"></script>
</body>
</html>