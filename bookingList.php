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

<title>Booking Paket</title>
</head>


<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="sampul.html"></div>
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container grid">
		<div class="row">
				<table class="table striped">
                	<thead>
                    	<tr class="info fg-white">
                        	<th class="text-left">ID Pesan</th>
                            <th class="text-left">Tanggal Pesan</th>
                            <th class="text-left">Tanggal Tour</th>
                            <th class="text-left">Paket Tour</th>
                            <th class="text-left">Tempat Penginapan</th>
                            <th class="text-left">Harga Paket</th>
                            <th class="text-left">Harga Penginapan</th>
                            <th class="text-left">Harga Total</th>
                            <th class="text-left">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
						$comot=mysqli_query($kon,"SELECT * FROM tbl_pesan, tbl_paket, tbl_hotel, tbl_user WHERE tbl_pesan.id_user=tbl_user.id_user AND tbl_pesan.id_paket=tbl_paket.id_paket AND tbl_pesan.id_hotel=tbl_hotel.id_hotel AND username='$username'");
						
						while($isi_tbl=mysqli_fetch_array($comot))
						{
						$total_harga	=$isi_tbl['harga_paket']+$isi_tbl['harga'];
						if($isi_tbl['status']=='S2'){
							$txtS="Telah malakukan pembayaran";
						}else if($isi_tbl['status']=='S3'){
							$txtS="Melakukan pembayaran di tempat";
						}
					?>
                    	<tr>
                        	<td>WISATHAN-00<?php echo $isi_tbl['id_pesan']; ?></td>
                            <td><?php echo $isi_tbl['tgl_pesan']; ?></td>
                            <td><?php echo $isi_tbl['tgl_tour']; ?></td>
                            <td><?php echo $isi_tbl['nama_paket']; ?></td>
                            <td><?php echo $isi_tbl['hotel']; ?></td>
                            <td><?php echo $isi_tbl['harga_paket']; ?> IDR</td>
                            <td><?php echo $isi_tbl['harga']; ?> IDR</td>
                            <td><?php echo $total_harga; ?> IDR</td>
                            <td><?php
								$now= date("Y-m-d");
								if($isi_tbl['status']=='S2'&&$isi_tbl['tgl_tour']>=$now||$isi_tbl['status']=='S3'&&$isi_tbl['tgl_tour']>=$now){
								?>
								<a class="button" href="bookingFinish.php?id=<?php echo $isi_tbl[0]; ?>" data-hint="<?php echo $txtS ?>">Cetak Tiket</a>
								<?php
								}else if($isi_tbl['status']=='S4'){
									echo "Telah Tour";
								}else if($isi_tbl['tgl_tour']<$now){
									echo "<a class='text-warning'>Kadaluarsa!!</a>";
								}else{
									echo "Menunggu";
								?>
									<br /><a class="button" href="uploadBukti.php?id=<?php echo $isi_tbl[0]; ?>" data-hint="Upload Bukti Pembayaran">Upload Bukti</a>
								<?php
								}
								?>
								</td>
                        </tr>
                    <?php
						}
					?>
                    </tbody>
                    
                </table>
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