<?php
include "config/koneksi.php";
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
	<script src="js/docs.js"></script>
    
    <style>
	</style>
	
<title>Selamat Datang di WISATHAN</title>

</head>

<body class="metro"><div id="scroll"></div>
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="sampul.html"></div>
	<br />
	<div class="container row">
        <div class="grid fluid">
            <div class="border padding20">
				<legend class="text-right"><h2>Daftar Penginapan di Jawa Timur</h2></legend>
					<div class="accordion" data-role="accordion" data-closeany="true">
                        <?php
						$comot=	mysqli_query($kon,"SELECT * FROM tbl_hotel,tbl_daerah WHERE tbl_hotel.kd_daerah=tbl_daerah.kode");   
						while($ngisi=	mysqli_fetch_array($comot)){
						?>	
							
						<div class="accordion-frame">
							<a class="heading bg-darkCobalt fg-white" href="#"><?php echo $ngisi['hotel']; ?> - <?php echo $ngisi['daerah']; ?><span class="place-right"><?php echo $ngisi['harga']; ?> IDR</span></a>
							<div class="content">
								<p>Bintang-<?php echo $ngisi['bintang']; ?></p>
								<?php echo $ngisi['ket_hotel']; ?>
							</div>
						</div>							
						<?php
						}
						?>
					</div>
            </div>
        </div>
    </div>
    
    <footer class="dark" data-load="bawahan.html"></footer>
</body>
</html>
