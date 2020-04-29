<?php 

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

$mpdf = new \Mpdf\Mpdf();
$html = '
		<!DOCTYPE html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Daftar Mahasiswa</title>
		<style>
			img {
				width:150px;
				height:200px;
				object-position: top;
				object-fit: center;
			}
		</style>
		</head>
		<body>
			<h1>Daftar Mahasiswa</h1>
			<table border="1" cellspacing="0" cellpadding="10">
				<tr>
					<th>No</th>
					<th>Profile</th>
					<th>Nama</th>
					<th>NRP</th>
					<th>Email</th>
					<th>Jurusan</th>
				</tr>';

			$i = 1;
			foreach( $mahasiswa as $mhs ) {
				$html .= '<tr>
						<td>'. $i++ .'</td>
						<td><img src="img/'. $mhs["gambar"] .'"></td>
						<td>'. $mhs["nama"] .'</td>
						<td>'. $mhs["nrp"] .'</td>
						<td>'. $mhs["email"] .'</td>
						<td>'. $mhs["jurusan"] .'</td>
				</tr>';
			}

		$html .= '</table>
		</body>
		</html>
';
$mpdf->SetProtection(array(), 'UserPassword', 'MyPassword', $length = 128);
$mpdf->WriteHTML($html);
// https://mpdf.github.io/reference/mpdf-functions/output.html
$mpdf->Output('Hello World.pdf', \Mpdf\Output\Destination::INLINE);

 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
</head>
<body>

</body>
</html>