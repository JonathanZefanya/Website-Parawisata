	<nav class="navigation-bar dark">
        <nav class="navigation-bar-content container">
        	<a href="index.html" class="element"><span class="icon-home"></span> BERANDA &trade;</a>
            <span class="element-divider"></span>
                
			<a class="element1 pull-menu" href="#"></a>
			<ul class="element-menu">
				<li>
					<a class="dropdown-toggle" href="#"> Tentang Kami </a>
					<ul class="dropdown-menu" data-role="dropdown">
						<li><a href="aboutUs.php?post=profil">Profil</a></li>
						<li><a href="listPaket.php">Daftar Paket</a></li>
						<li><a href="listPenginapan.php">Daftar Penginapan</a></li>
						<li class="divider"></li>
						<li><a href="aboutUs.php?post=syarat">Ketentaun &amp; Persyaratan</a></li>
						<li><a href="aboutUs.php?post=reservasi">Cara Reservasi</a></li>
						<li><a href="aboutUs.php?post=pembayaran">Cara Pembayaran</a></li>
					</ul>  
				</li>
				<li>
					<a class="dropdown-toggle" href="#"> Tentang Papua </a>
					<ul class="dropdown-menu" data-role="dropdown">
						<li><a href="sumbar.php?post=profil">Profil</a></li>
						<li><a href="sumbar.php?post=sejarah">Sejarah</a></li>
						<li><a href="galeri.php">Galeri</a></li>
						<li class="divider"></li>
						<li><a href="sumbar.php?post=wisata">Objek Wisata</a></li>
						<li><a href="sumbar.php?post=kuliner">Varian Kuliner</a></li>
						<li><a href="sumbar.php?post=budaya">Budaya</a></li>
					</ul>
				</li>
				
				<a class="element brand" href="contact.php">Contact</a>
				<!-- -------------------------MENU KANAN---------------------------- -->
					 
				<a class="element place-right" href="https://www.facebook.com/pmeme.handal.94/">
						<span class="icon-facebook" style="background: white;
						   color: black;
						   padding: 3px;
						   border-radius: 50%">
						</span>
				</a>
				<a class="element place-right" href="https://www.instagram.com/xeadesta/">
						<span class="icon-instagram" style="background: white;
						   color: black;
						   padding: 3px;
						   border-radius: 50%">
						</span>
				</a>
				<a class="element place-right" href="https://github.com/jonathanzefanya">
						<span class="icon-github" style="background: white;
						   color: black;
						   padding: 3px;
						   border-radius: 50%">
						</span>
				</a>
								
	<?php session_start();

	if(isset($_SESSION['username'])){
	?>
				<span class="element-divider place-right"></span>
				<div class="element place-right">                   
					<a class="dropdown-toggle icon-cog" href="#"></a>
					<ul class="dropdown-menu" data-role="dropdown">
						<li><a href="profil.php">Profil</a></li>
						<li><a href="booking.php">Booking</a></li>
						<li><a href="bookingList.php">Cek Booking</a></li>
						<li class="divider"></li>
						<li><a href="logout.php">Keluar</a></li>
					</ul>
				</div>
				<a href="profil.php" class="element place-right">Selamat datang, <?php echo "$_SESSION[username]"; ?></a>
				
	<?php
	}else{
	?>
				<span class="element-divider"></span>
				<a href="formRegistrasi.php" class="element">Log in</a>
	<?php
	}
	?>
				
            </ul>
        </nav>
    </nav>

<?php
include"chat.php";
?>
