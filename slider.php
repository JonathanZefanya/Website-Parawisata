<?php
include "config/koneksi.php";
?>
		<div class="ribbed-indigo no-tablet-portrait no-phone">
            <div class="container padding20 fg-white">
			
                <div class="carousel bg-transparent no-overflow" id="slide">
					<?php
						$comot=	mysqli_query($kon,"SELECT * FROM setup_slide");   
						while($ngisi=	mysqli_fetch_array($comot)){
					?>
					<div class="slide">
						<h2 class="fg-white"><?php echo $ngisi['judul']; ?></h2>
						<?php
							if ($ngisi['gambar']!=""){ ?>
						<div class="place-right">
                            <img src="images/<?php echo $ngisi['gambar']; ?>"
                                 alt="" class="span3"/>
                        </div>
					<?php
							}
					?>
						<div class="fg-white"><?php echo $ngisi['konten']; ?></div>
					</div>
					<?php
						}
					?>
                                        
                </div>
				
                <script>
                    $(function(){
                        $("#slide").carousel({
                            height: 210,
                            period: 5000,
                            duration: 1000,
                            effect: 'fade',
                            markers: {
                                show: true
                            }
                        });
                    })
                </script>
            </div>
        </div>