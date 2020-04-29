<?php 
sleep(1);
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa WHERE 
			nama LIKE '%$keyword%' OR
			nrp LIKE '%$keyword%' OR
			email LIKE '%$keyword%' OR
			jurusan LIKE '%$keyword%'
			";
$mahasiswa = query($query);




 ?>
 <table border="1" cellspacing="0" cellpadding="10">
	<tr>
		<th>No</th>
		<th>Profile</th>
		<th>Nama</th>
		<th>NRP</th>
		<th>Email</th>
		<th>Jurusan</th>
		<th>Aksi</th>
	</tr>

	<?php $no = 1; foreach( $mahasiswa as $mhs ) : ?>
	<tr>
		<td><?= $no++; ?></td>
		<td><img src="img/<?= $mhs["gambar"]; ?>"></td>
		<td><?= $mhs["nama"]; ?></td>
		<td><?= $mhs["nrp"]; ?></td>
		<td><?= $mhs["email"]; ?></td>
		<td><?= $mhs["jurusan"]; ?></td>
		<td>
			<a href="ubah.php?id=<?= $mhs['id']; ?>">ubah</a>
			<a href="hapus.php?id=<?= $mhs['id']; ?>" onclick="return confirm('Yakin?')">hapuss</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php if(!$mahasiswa) : ?>
	<p style="color:red;">Data tidak ditemukan!</p>
<?php endif; ?>