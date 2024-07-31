<?php
	$host	= "localhost";
	$user	= "root";
	$pass	= "root";
	$db		= "wisata";
	
	$kon = mysqli_connect($host, $user, $pass);
	$kondb = mysqli_select_db($kon, $db);
	
	
	//test koneksi
	
	/*if($kon){
		echo "Terkoneksi dengan mysqli";
		if($kondb){
			echo "DataBase $db yang dipilih";
		}else{
			echo "DataBase tidak ada";
		}
	}else{
		echo "Koneksi GAGAL";
	}
	*/
?>