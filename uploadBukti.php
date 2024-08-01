<?php session_start();

if(isset($_SESSION['username'])){

	//koneksi terpusat
	include "config/koneksi.php";
	$username=$_SESSION['username'];
	
	if(isset($_POST['Submit']))
	{
		$nama_file   = $_FILES['bukti']['name'];
		$lokasi_file = $_FILES['bukti']['tmp_name'];
		if(!empty($lokasi_file)){
			move_uploaded_file($lokasi_file, "images/$nama_file");
			
			$query = mysqli_query($kon,"INSERT INTO tbl_bukti (id_pesan, file) VALUE ('".$_GET['id']."','$nama_file')");
			
			if($query){
				header("location:uploadBukti.php?status=Anda Berhasil Upload Bukti Pembayaran");
			}
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="css/iconFont.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">


    <!-- Load JavaScript Libraries -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.widget.min.js"></script>
    <script src="js/jquery/jquery.mousewheel.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="js/load-metro.js"></script>

    <!-- Local JavaScript -->
    <script src="js/docs.js"></script>
    
    <style>
    </style>

<title>Upload bukti pembayaran</title>
</head>


<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="sampul.html"></div>
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container grid">
		<div class="row">
			<div class="span5">
				<legend>Upload Bukti Pembayaran</legend>
				<p><strong><?php  if(isset($_GET['status'])){ echo "&laquo; ".$_GET['status']." &raquo;"; }?></strong></p><br />
				<p>Upload bukti bahwa anda telah melakukan pembayaran. Bukti yang diupload hanya berupa gambar (jpg, png, gif).</p>
				<form name="formUploadBukti" method="post" action="#" enctype="multipart/form-data">
					<div class="input-control text" data-role="input-control">
						<input type="file" name="bukti">
						<button class="btn-upload"></button>
					</div>
					
					<input type="submit" name="Submit" value="Kirim">
				</form>
			</div>
		</div>
    </div>
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    
    <footer class="dark" data-load="bawahan.html"></footer>
</body>
</html>
<?php
}else{
	session_destroy();
	header('Location:formRegistrasi.php?status=Silahkan Login');
}
?>