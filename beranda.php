<?php
include "config/koneksi.php";
?>

<div class="container">
	<div class="grid">
			<div class="row">
            <div class="border padding20 span10" style="background-color: #F5F5F5;">
				<div class="panel no-border">
					<?php
						$comot=	mysqli_query($kon, "SELECT * FROM setup_dasboard ORDER BY id_dasboard DESC LIMIT 50");   
						while($ngisi=	mysqli_fetch_array($comot)){
					?>
                    <div class="panel-header ribbed-amber fg-white"><strong><?php echo $ngisi['nama']; ?> (<?php echo $ngisi['waktu'];?>)</strong></div>
                    <div class="panel-content fg-dark nlp nrp">
						<?php
							if ($ngisi['gambar']!=""){ ?>
						<img src="images/<?php echo $ngisi['gambar']; ?>" class="place-right margin10 nlm ntm size3">
						<?php	}?>
                        
						<?php echo $ngisi['konten'];?>
                    </div>
					<?php
						}
					?>
				</div>
				
            </div>
			<div class="ui text container center aligned">
    <h1 class="ui header"></h1>
</div>   
			<div class="padding20 span4" style="background-color: #F1F1F1;">
				<div class="panel no-border">
                    <div class="input-control text" data-role="input-control">
									<input type="text" name="nama" required placeholder="Search..." >
									<button class="btn-clear" tabindex="-1"></button>
								</div>
                    <div class="panel-content fg-dark nlp nrp">
						<center><div class="calendar" data-role="calendar"></div></center> <br />
						<div class="times" data-role="times" data-style-background="bg-lightBlue" data-style-divider="fg-lightBlue"></div>
                    </div>
				</div>
				
				<div class="panel no-border">
                    <div class="panel-header ribbed-cyan fg-white">RECENT UPDATES</div>
					<div class="panel-content fg-dark nlp nrp">
					<div><a href="https://kampoengngawi.com/file.post.news/seni-kejadian-upacara-kebo-ketan/" style="font-size: 16px; text-decoration:none; color: #616469;">UPACARA KEBO KETAN?</a></div>
					<div><a href="https://travel.detik.com/domestic-destination/d-3597043/kisah-di-balik-berdirinya-museum-trinil" style="font-size: 16px; text-decoration:none; color: #616469;">MANUSIA PURBA DAN MUSEUM TRINIL NGAWI </a>
					</div>
					<div><a href="https://www.kompasiana.com/www.teguhhariawan/kisah-pilu-dibalik-keindahan-ranu-grati_552e5e856ea834a2548b4582" style="font-size: 16px; text-decoration:none; color: #616469;">MISTERI AMFIBI TENGGELAM DI DANAU RANU GATI </a></div>
					<div><a href="https://kampoengngawi.com/file.post.news/menikmati-kemegahan-alun-alun-ngawi/" style="font-size: 16px; text-decoration:none; color: #616469;">MENIKMATI KEMEGAHAN ALUN-ALUN NGAWI</a></div>
					<div><a href="https://news.detik.com/jawatimur/1629682/pantai-klayar-pacitan-dikenal-eksotis-namun-berbahaya" style="font-size: 16px; text-decoration:none; color: #616469;">PANTAI KLAYAR, EKSOTIS NAMUN BERBAHAYA</a></div>
					</div>
					</div>
					
				<div class="panel no-border">
                    <div class="panel-header ribbed-cyan fg-white">KOMENTAR</div>
                    <div class="panel-content fg-dark nlp nrp">
						<div id="komenList" class="border" data-role="scrollbox" data-scroll="vertical">
						<?php
						$comot_komen = mysqli_query($kon, "SELECT * FROM komentar ORDER BY id_komentar DESC LIMIT 5");   
						while($ngisi_komen = mysqli_fetch_array($comot_komen)){
							$thn=substr($ngisi_komen['waktu'],0,4);
							$bln=substr($ngisi_komen['waktu'],5,2);
							$tgl=substr($ngisi_komen['waktu'],8,2);
							$jam=substr($ngisi_komen['waktu'],11,8);
							if($bln==1){ $x="Jan"; }
							else if($bln==2){ $x="Feb";	}
							else if($bln==3){ $x="Mar"; }
							else if($bln==4){ $x="Apr"; }
							else if($bln==5){ $x="Mei"; }
							else if($bln==6){ $x="Jun"; }
							else if($bln==7){ $x="Jul"; }
							else if($bln==8){ $x="Agu"; }
							else if($bln==9){ $x="Sep"; }
							else if($bln==10){ $x="Okt"; }
							else if($bln==11){ $x="Nov"; }
							else{ $x="Des"; }
							echo "<p class='text-info'><strong>".$ngisi_komen['nama']."</strong> <em>says</em>&nbsp;&nbsp;:";
							echo "<br><small>".$jam.", ".$tgl."&nbsp".$x."&nbsp".$thn."</small></p>";
							echo "<p class='tertiary-text-secondary'><em>".$ngisi_komen['komentar']."</em></p>";
							echo "<br />";
						}
						?>
						</div>
						<script>
							$(function(){
								$("#komenList").scrollbar({
									height: 300,
									axis: 'y'
								});
							});
						</script>
						<form method="POST" action="kirimKomentar.php">
							<fieldset>
								<div class="input-control text" data-role="input-control">
									<input type="text" name="nama" required placeholder="Input Nama:" >
									<button class="btn-clear" tabindex="-1"></button>
								</div>
								<div class="input-control textarea" data-role="input-control" placeholder="Tuliskan komentar disini!">
									<textarea name="komentar" rows=3></textarea>
								</div>
								<input name="Tambah" type="submit" value="Kirim" class="bg-dark fg-white" data-hint="Silahkan tinggalkan komentar">
							</fieldset>
						</form>
                    </div>
				</div>
				
				<div class="panel no-border">
                    <div class="panel-header ribbed-cyan fg-white">PAPUA</div>
                    <div class="panel-content fg-dark nlp nrp">
						<div class="tile double live" data-role="live-tile">
							<div class="tile-content image">
								<img src="images/galeri/labak.png" class="cover1" />
							</div>
							<div class="tile-content image">
								<img src="images/galeri/sar2.jpg" class="cover1" />
							</div>
							<div class="tile-content image">
								<img src="images/galeri/Bromo.jpg" class="cover1"/>
							</div>
							<div class="tile-content image">
								<img src="images/galeri/end.jpg" class="cover1" />
							</div>
                        </div>
                    </div>
				</div>				
            </div>
		</div>
	</div>
</div>