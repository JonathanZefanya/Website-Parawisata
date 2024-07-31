<?php session_start();

if(isset($_SESSION['username'])){

	//koneksi terpusat
	include "config/koneksi.php";
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/print.css" rel="stylesheet">
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


<body class="metro" style="background-color: #F1F1F1;">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
<?php
	$comot=mysqli_query($kon,"SELECT * FROM tbl_pesan, tbl_paket, tbl_hotel, tbl_user WHERE tbl_pesan.id_user=tbl_user.id_user AND
						tbl_pesan.id_paket=tbl_paket.id_paket AND tbl_pesan.id_hotel=tbl_hotel.id_hotel AND id_pesan=".$_GET['id']);
	$isi_tbl=mysqli_fetch_array($comot);

?>
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
	<br />
	<form>
    <div class="container padding20 grid" style="background-color: #FFFFFF;">
		<legend>WISATHAN Tour dan Travel <i class="place-right"><small>Tanggal : <?php $tgl= date("d M Y"); echo $tgl;?></small></i></legend>
		<div class="row">
            <div class="span4">
				<p class="tertiary-text-secondary"><strong>WISATHAN Tour and Travel </strong><br />
				Perumahan Taman Aries<br />
				Blok F Nomor 5<br />
				Ngawi, Jawa Timur</p>
				<p class="tertiary-text-secondary">anastasiadpp@gmail.com<br />
				081296703788</p>
				<p class="tertiary-text-secondary">BNI : 0350520214 a/n JONATHAN NATHANNAEL ZEFANYA<br />
				Mandiri : 1710000395346 a/n JONATHAN NATHANNAEL ZEFANYA</p>
            </div>
			<div class="span3">
				<a class="tertiary-text-secondary"></a>To<br />
				<p><strong><?php echo $isi_tbl['nama_user'];?></strong><br />
				<?php echo $isi_tbl['email_user'];?><br />
				Phone: <?php echo $isi_tbl['no_hp'];?><br />
				<?php echo $isi_tbl['alamat'];?></p>	
            </div>
			<div class="span4 place-right">
				<p class="tertiary-text-secondary text-right">Tasia-00<?php echo $isi_tbl['id_pesan'];?></p>
				<p class="tertiary-text-secondary text-right">Tgl Pesan: <?php echo $isi_tbl['tgl_pesan'];?><br />
				Tgl Perjalanan: <?php echo $isi_tbl['tgl_tour'];?></p>	
            </div>
			
        </div>
		<div class="row">
            <table class="table">
                <thead>
                   	<tr>
                       	<th class="text-left" width="5%">#</th>
						<th class="text-left" width="30%">Nama Paket/Penginapan</th>
						<th class="text-left" width="15%">Kode</th>
						<th class="text-left" width="35%">Keterangan</th>
						<th class="text-center" width="15%">Biaya</th>
					</tr>
				</thead>
				<tbody>
                   	<tr>
                       	<td class="text-left" width="5%">1</td>
						<td class="text-left" width="30%"><?php echo $isi_tbl['nama_paket'];?></td>
						<td class="text-left" width="15%">PKT14-00<?php echo $isi_tbl['id_paket'];?></td>
						<td class="text-left" width="35%"><?php echo $isi_tbl['ket_paket'];?></td>
						<td class="text-right" width="15%"><?php echo $isi_tbl['harga_paket'];?> IDR</td>
					</tr>
					<tr>
                       	<td class="text-left" width="5%">2</td>
						<td class="text-left" width="30%"><?php echo $isi_tbl['hotel'];?></td>
						<td class="text-left" width="15%"><?php echo $isi_tbl['kd_daerah'];?>-HT0<?php echo $isi_tbl['id_hotel'];?></td>
						<td class="text-left" width="35%"><?php $baca=substr($isi_tbl['ket_hotel'], 0, 250); echo $baca." ...";?></td>
						<td class="text-right" width="15%"><?php echo $isi_tbl['harga'];?> IDR</td>
					</tr>
					<tr class="selected">
                       	<td class="text-left" width="5%"></td>
						<td class="text-left" width="30%"></td>
						<td class="text-left" width="15%"></td>
						<td class="text-left" width="35%"><strong>Total Biaya</strong></td>
						<td class="text-right" width="15%"><strong><?php echo $total=$isi_tbl['harga_paket']+$isi_tbl['harga'];?></strong> IDR</td>
					</tr>
				</tbody>
			</table>	
			
        </div>
		<a class="image-button primary image-left" href="javascript:window.print()"><i class="icon-printer bg-cobalt"></i>Print</a>
		<a class="image-button danger" href="ticket.php?id=<?php echo $isi_tbl['id_pesan'];?>" target="_blank">Download Tiket PDF<i class="icon-file-pdf bg-red"></i></a>
    </div>
	</form>
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