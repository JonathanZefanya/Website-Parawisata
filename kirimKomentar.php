<?php
include "config/koneksi.php";
	
	$nama=ucwords(strtolower($_POST['nama']));
	mysqli_query($kon,"INSERT INTO komentar (nama,komentar,waktu) value ('$nama', '$_POST[komentar]', NOW())") or die(mysqli_error());
	
	header('location:index.html');
?>