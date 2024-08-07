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
		.carousel .slide iframe {
        width: 100%;
        height: 100%;
    }
	</style>
	
<title>Selamat Datang di WISATHAN</title>

</head>

<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="slider.php"></div>
	<br />
    <div class="container grid">
		<div class="border padding15">
        <div class="row">
			<div class="span7">
				<legend>Galeri Raja Ampat</legend>
				<div class="carousel" id="imgSlide">
					<div class="slide">
						<img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/74/2024/07/24/RA_Pianemoisland_indtravel-1217639176.jpg" class="cover1" />
					</div>
					<div class="slide">
						<img src="images/galeri/mad2.png" class="cover1" />
					</div>
					<div class="slide">
                        <iframe class="cover1" src="https://www.youtube.com/embed/Q-OWraAwJOE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
				</div>
			</div>

			<div class="span7">
				<legend>Galeri Danau Sentani</legend>
				<div class="carousel" id="imgSlide1">
					<div class="slide">
						<img src="https://dfcm824dmlg8u.cloudfront.net/wp-content/uploads/2021/06/1606-danau-sentani.jpg" class="cover1" />
					</div>
					<div class="slide">
						<img src="https://img.inews.co.id/media/822/files/inews_new/2023/05/03/Danau_Sentani.jpg" class="cover1" />
					</div>
					<div class="slide">
                        <iframe class="cover1" src="https://www.youtube.com/embed/L1CwBPrUSYM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
				</div>
			</div>
        </div>
		</div>
		
		<div class="border padding15">
        <div class="row">
			<div class="span7">
				<legend>Galeri Taman Wasur</legend>
				<div class="carousel" id="imgSlide2">
					<div class="slide">
						<img src="https://v1.indonesia.travel/content/dam/indtravelrevamp/id-id/ide-liburan/7-destinasi-wisata-di-pulau-papua-yang-indahnya-tiada-dua/tamnas%20wasur.jpg" class="cover1" />
					</div>
					<div class="slide">
						<img src="https://agrozine.id/wp-content/uploads/2020/10/kawasan-basah-1024x677.jpg" class="cover1"/>
					</div>
					<div class="slide">
                        <iframe class="cover1" src="https://www.youtube.com/embed/IdxkRSRDhps" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>					
				</div>
			</div>

			<div class="span7">
				<legend>Galeri Air Terjun Wafsarak</legend>
				<div class="carousel" id="imgSlide3">
					<div class="slide">
						<img src="https://v1.indonesia.travel/content/dam/indtravelrevamp/id-id/ide-liburan/7-destinasi-wisata-di-pulau-papua-yang-indahnya-tiada-dua/air%20terjun%20wafsarak.jpg" class="cover1" />
					</div>
					<div class="slide">
						<img src="https://img.inews.co.id/media/822/files/inews_new/2023/05/03/Air_Terjun_Wafsarak.jpg" class="cover1" />
					</div>
					<div class="slide">
                        <iframe class="cover1" src="https://www.youtube.com/embed/l_00DBy_9fE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
				</div>
			</div>
        </div>
		</div>
		
		<div class="border padding15">
        <div class="row">
			<div class="span7">
				<legend>Galeri Taman Nasional Lorentz</legend>
				<div class="carousel" id="imgSlide4">
					<div class="slide">
						<img src="https://v1.indonesia.travel/content/dam/indtravelrevamp/id-id/ide-liburan/7-destinasi-wisata-di-pulau-papua-yang-indahnya-tiada-dua/tamnas%20lorentz.jpg" class="cover1" />
					</div>
					<div class="slide">
						<img src="https://asset-2.tstatic.net/jatim/foto/bank/images/taman-nasional-lorentz-di-papua.jpg" class="cover1"/>
					</div>				
					<div class="slide">
                        <iframe class="cover1" src="https://www.youtube.com/embed/HSBghu7dut8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>	
				</div>
			</div>
        </div>

		
		</div>
    <footer class="dark" data-load="bawahan.html"></footer>
	
	<script>
		$(function(){
			$("#imgSlide").carousel({
				effect: 'slide',
				period: 3000,
				markers: {
					show: true,
					type: 'default',
					position: 'bottom-right'
				}
			});
			$("#imgSlide1").carousel({
				effect: 'fade',
				period: 3000,
				markers: {
					show: true,
					type: 'default',
					position: 'bottom-right'
				}
			});
			$("#imgSlide2").carousel({
				effect: 'slowdown',
				period: 3000,
				markers: {
					show: true,
					type: 'default',
					position: 'bottom-right'
				}
			});
			$("#imgSlide3").carousel({
				effect: 'switch',
				period: 3000,
				markers: {
					show: true,
					type: 'default',
					position: 'bottom-right'
				}
			});
			$("#imgSlide4").carousel({
				effect: 'switch',
				period: 3000,
				markers: {
					show: true,
					type: 'default',
					position: 'bottom-right'
				}
			});
		})
	</script>
</body>
</html>
