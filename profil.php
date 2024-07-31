<?php session_start();

if(isset($_SESSION['username'])){

	//koneksi terpusat
	include "config/koneksi.php";
	$username=$_SESSION['username'];
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

<title>Detail User</title>
</head>

<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="sampul.html"></div>
<?php
	$query	=mysqli_query($kon,"SELECT * FROM tbl_user WHERE username='$username'");
	$tampil	=mysqli_fetch_array($query);
?>
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container">
            <div class="span6">
                <legend><p><h3><?php echo $tampil['nama_user']; ?></h3></p></legend>
            </div>
			<div class="span6">
                <table class="table striped hovered">
                	<tbody>
                    	<tr>
                        	<th class="text-left">Email</th>
                            <th class="text-left"><abbr title="Email tidak dapat dirubah!"><em><?php echo $tampil['email_user']; ?></em></abbr></th>
                        </tr>
						<tr>
                        	<th class="text-left">Nomor Identitas</th>
                            <th class="text-left">[<?php echo $tampil['tipe_id']; ?>] <?php echo $tampil['no_id']; ?></th>
                        </tr>
						<tr>
                        	<th class="text-left">Telpon/Handphone</th>
                            <th class="text-left"><em><?php echo $tampil['no_hp']; ?></em></th>
                        </tr>
						<tr>
                        	<th class="text-left">Nomor Rekening</th>
                            <th class="text-left"><abbr title="Rekening digunakan sebagai konfirmasi pembayaran tiket secara transfer."><em><?php echo $tampil['no_rek']; ?> a/n. <?php echo $tampil['nama_rek']; ?></em></abbr></th>
                        </tr>
						<tr>
                        	<th class="text-left">Tanggal Lahir</th>
                            <th class="text-left"><em><?php echo $tampil['tgl_lahir']; ?></em></th>
                        </tr>
						<tr>
                        	<th class="text-left">Jenis Kelamin</th>
                            <th class="text-left"><em><?php if($tampil["jekel"]=='L'){
																echo "Laki-laki"; 
															}else if($tampil["jekel"]=='P'){
																echo "Perempuan";
															}else{
																echo "";
															}?></em></th>
                        </tr>
						<tr>
                        	<th class="text-left">Alamat</th>
                            <th class="text-left"><em><?php echo $tampil['alamat']; ?></em></th>
                        </tr>
                    </tbody>
				</table>
				<p class="tertiary-text-secondary"><small>nb: Silahkan lengkapi biodata ini dulu sebelum melakukan booking!!</small></p>
				<a class="button" href="editProfil.php">Edit Profil</a>
            </div>
    </div>
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <br />
    <footer class="dark" data-load="bawahan.html"></footer>
</body>
</html>
<?php
}else{
	session_destroy();
	header('Location:formRegistrasi.php?status=Silahkan Login');
}
?>