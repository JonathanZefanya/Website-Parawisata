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

<title>Contact</title>
</head>

<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
	<div class="" data-load="slider.php"></div>
	<br />
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container">
        <div class="panel" data-role="panel">
            <div class="panel-header bg-darkRed fg-white">
				Contact
            </div>
            <div class="panel-content">
				<?php 
					include "config/koneksi.php";
					$comot=	mysqli_query($kon, "SELECT * FROM contact LIMIT 1");   
					$ngisi=	mysqli_fetch_array($comot);
				?>
				<div class="grid">
				<div class="row">
					<div class="span4">
						<table class="table hovered">
							<tbody>
								<tr class=""><td>Alamat</td><td class="right"><?php echo $ngisi['alamat']; ?></td></tr>
								<tr class=""><td>Kota</td><td class="right"><strong><?php echo $ngisi['kota']; ?></strong></td></tr>
								<tr class=""><td>E-mail</td><td class="right"><strong><?php echo $ngisi['email']; ?></strong></td></tr>
								<tr class=""><td>Telepon</td><td class="right"><strong><?php echo $ngisi['no_tlp']; ?></strong></td></tr>
								<tr class=""><td>Handphone</td><td class="right"><strong><?php echo $ngisi['no_hp']; ?></strong></td></tr>
							</tbody>
						</table>
					</div>
					<div class="span8">
						<p><?php echo $ngisi['content']; ?></p>
					</div>
				</div>
				</div>
            </div>
        </div>
    </div>
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <br />
    <footer class="dark" data-load="bawahan.html"></footer>
</body>
</html>