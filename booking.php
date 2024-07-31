<?php session_start();

if(isset($_SESSION['username'])){

	//koneksi terpusat
	include "config/koneksi.php";
	$username=$_SESSION['username'];
	
	if(isset($_POST['Submit']))
	{
		mysqli_query($kon, "INSERT INTO tbl_pesan (id_user, id_paket, id_hotel, tgl_pesan, tgl_tour, status)
						value ('$_POST[id_user]','$_POST[paket]','$_POST[hotel]',NOW(),'$_POST[dateTour]','$_POST[status]')") or die(mysqli_error($kon));
		
		header("location:bookingList.php");
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

<title>Booking Paket</title>
</head>


<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="sampul.html"></div>
	
<?php
	$query	=mysqli_query($kon, "SELECT * FROM tbl_user WHERE username='$username'");
	$tampil	=mysqli_fetch_array($query);

	echo "<script language=\"JavaScript\" src=\"comboBox.js\"></script>";
?>
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container">
        <div class="grid">
		<div class="row">
			<div class="span4">
				<legend>Tentukan Tanggal Tour</legend>
                <div class="calendar" id="cal-events"></div>
				<div id="calendar-output2"></div>
            </div>
			<script>
				$(function(){
					var cal = $("#cal-events").calendar({
						multiSelect: false,
						click: function(d){
							var out = $("#dateTour").val("");
							out.val(d);
						}
					});
					cal.calendar('setDate', '2013-10-21');
					cal.calendar('setDate', '2013-10-2');
				})
            </script>
			
            <div class="span6">
                <form name="formBooking" method="post" action="#">
                    <fieldset>
                        <legend>Silahkan Dilengkapi Form Berikut!</legend>
                        <lable>Nama Lengkap</lable>
                        <div class="input-control text" data-role="input-control">
							<input type="hidden" name="id_user" readonly
							 value="<?php echo $tampil['id_user'];?>">
                            <input type="text" name="nama" readonly
							 value="<?php echo $tampil['nama_user'];?>">
                        </div>
						<lable>Tanggal Tour</lable>
                        <div class="input-control text" data-role="input-control">
                            <input id="dateTour" type="text" name="dateTour" required value="" placeholder="Auto value, Ketika Kalender diklik">
                            <button class="btn-clear" tabindex="-1"></button>
                        </div>
						
						<label>Pilih Tujuan Wisata</label>
                        <div class="input-control select" data-role="input-control">						
							<select name='tujuan' onChange='DinamisDaerah(this);' class="cmb">
							<option value="">--Pilih Tujuan Wisata-</option>
							<?php
								$query = "select * from tbl_daerah";
								$result = mysqli_query($kon, $query);
								while ($set=mysqli_fetch_array($result))
								{
									echo "<option value=$set[kode]>$set[daerah]</option>";
								}
								echo"</select>";
							?>
						</div>
						
						<label>Pilih Penginapan</label>
						<div id="hotel" class="input-control select" data-role="input-control">
							<select class="cmb">
								<option value="">--Pilih Hotel--</option>
							</select>
                        </div>
						
						<label>Pilih Kategori Paket</label>
                        <div class="input-control select" data-role="input-control">						
							<select name='kategori' onChange='DinamisKategori(this);' class="cmb">
							<option value="">--Pilih Kategori--</option>
							<?php
								$query = "select * from tbl_kategori";
								$result = mysqli_query($kon, $query);
								while ($set=mysqli_fetch_array($result))
								{
									echo "<option value=$set[id_kategori]>$set[kategori]</option>";
								}
								echo"</select>";
							?>
						</div>
						
						<label>Pilih Paket</label>
						<div id="paket" class="input-control select" data-role="input-control">
							<select class="cmb">
								<option value="">--Pilih Paket--</option>
							</select>
                        </div>
						<label>Anda ingin pembayaran di tempat?</label>
						<div>
							<div class="input-control radio" data-role="input-control">
                                <label>
                                <input type="radio" name="status" value="S3" />
                                <span class="check"></span>Iya
                                </label>
                            </div>
						</div>
						<div>
                            <div class="input-control radio" data-role="input-control">
                                <label>
                                <input type="radio" name="status" value="S1" checked />
                                <span class="check"></span>Tidak, Saya ingin via Transfer
                                </label>
                            </div>
						</div>
						
                        <input type="submit" name="Submit" value="Next">
                    </fieldset>
                </form>
            </div>
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