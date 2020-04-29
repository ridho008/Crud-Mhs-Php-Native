<?php 
// koneksi halaman ini ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];

	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah($data)
{
	global $conn;
	// ambil data dari setiap element form
	$nama = htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	// upload gambar dulu
	$gambar = upload();
	if( !$gambar ) {
		return false;
	}

	// query insert data
	$query = "INSERT INTO mahasiswa
				VALUES
				('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu');
				</script>
		";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
				</script>
		";
		return false;
	}

	// cek jika ukuran gambar terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
				</script>
		";
		return false;
	}


	// gambar siap diupload
	// genere nama gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;

}


function hapus($id)
{
	global $conn;

	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function ubah($data)
{
	global $conn;
	// ambil data dari setiap element form
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user milih gambar baru atau tidak
	if( $_FILES["gambar"]["error"] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}
	

	// query insert data
	$query = "
				UPDATE mahasiswa SET 
				nama = '$nama',
				nrp = '$nrp',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
			WHERE id = $id
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari($keyword)
{
	$query = "SELECT * FROM mahasiswa WHERE 
			nama LIKE '%$keyword%' OR
			nrp LIKE '%$keyword%' OR
			email LIKE '%$keyword%' OR
			jurusan LIKE '%$keyword%'
			";
	return query($query);
}


function register($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username udh ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user where username = '$username'");

	if(mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar');
		</script>";
		return false;
	}

	// cek konfirmasi pass
	if( $password !== $password2 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
		</script>";
		return false;
	} 

	// encripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES
	 					('', '$username', '$password')
	 ");
	return mysqli_affected_rows($conn);

}




 ?>