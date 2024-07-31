<?php
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$db   = "wisata";
	
	$pdo = new PDO("mysqli:host=$host; dbname=$db", $user, $pass);
	//Hanya TES
	/*if($pdo){
		echo "Koneksi ke DB Berhasil";
	}else{
		echo "Koneksi GAGAL";
	}*/
?>