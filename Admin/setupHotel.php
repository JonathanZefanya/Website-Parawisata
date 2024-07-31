<?php 
session_start();

if(isset($_SESSION['user_admin'])) {

	//koneksi terpusat
	include "../config/koneksi.php";
	$username = $_SESSION['user_admin'];
	$level = $_SESSION['level'];
	
	if(isset($_POST['Tambah'])){
		mysqli_query($kon,"INSERT INTO tbl_hotel (kd_daerah, hotel, bintang, harga, ket_hotel)
				value ('$_POST[kd_daerah]','$_POST[hotel]','$_POST[bintang]','$_POST[harga]','$_POST[ket_hotel]')")
				or die(mysqli_error($kon));
	}
	
	else if(isset($_POST['Edit'])){
		mysqli_query($kon,"UPDATE tbl_hotel SET kd_daerah = '$_POST[kd_daerah]', hotel = '$_POST[hotel]', bintang = '$_POST[bintang]', harga = '$_POST[harga]', ket_hotel = '$_POST[ket_hotel]' WHERE id_hotel = '$_POST[id]'");
	}
	
	else if(isset($_POST['Delete'])){
		mysqli_query($kon,"DELETE FROM tbl_hotel WHERE id_hotel = '$_POST[id]'");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Penginapan</title>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<!-- Page-Level Plugin CSS - Tables -->
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

       	<?php
			if($level=='admin'){
				include"nav.php";
			}else if($level=='operator'){
				include"nav_operator.php";
			}else{
				echo "Anda tidak punya hak access!! Hayoo!! sapa Loe??";
			}
		?>

        <div id="page-wrapper">
            <div class="col-lg-12">
                
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Setup Penginapan</h3></div>
                    <div class="panel-body">
                        <div class="row">
                        	<form name="setupPenginapan" action="setupHotel.php" method="post" enctype="multipart/form-data">
							<?php
                                if (isset($_GET['id'])) {
                                    $comot_id = mysqli_query($kon, "SELECT * FROM tbl_hotel WHERE id_hotel = " . $_GET['id']);
                                    if (mysqli_num_rows($comot_id) > 0) {
                                        $ngisi = mysqli_fetch_array($comot_id);
                                    } else {
                                        $ngisi = ['id_hotel' => '', 'kd_daerah' => '', 'hotel' => '', 'bintang' => '', 'harga' => '', 'ket_hotel' => ''];
                                    }
                                } else {
                                    $ngisi = ['id_hotel' => '', 'kd_daerah' => '', 'hotel' => '', 'bintang' => '', 'harga' => '', 'ket_hotel' => ''];
                                }
                            ?>
                                <fieldset>
                                <div class="col-lg-4">
									<input name="id" type="hidden" value="<?php echo $ngisi['id_hotel']; ?>">
                                	<div class="form-group">
                                    	<label>Pilih Daerah</label>
                            			<select class="form-control" name="kd_daerah">
                                        	<?php 
												$comot_kat = mysqli_query($kon,"SELECT * FROM tbl_daerah");
												while ($ngisi_kat = mysqli_fetch_assoc($comot_kat)){
													if($ngisi_kat['kode'] == $ngisi['kd_daerah']){
														echo "<option value='$ngisi_kat[kode]' selected>$ngisi_kat[daerah]</option>";
													}else{
														echo "<option value='$ngisi_kat[kode]'>$ngisi_kat[daerah]</option>";						
													}
												}
											?>
                                        </select>
									</div>
                                	<div class="form-group">
                                    	<label>Nama Penginapan</label>
                            			<input class="form-control" name="hotel" type="text" placeholder="ex: Nama Penginapan (Kelas Kamar) 1H" value="<?php echo $ngisi['hotel']; ?>">
                                	</div>
								</div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Star Rate</label>
                                        <select class="form-control" name="bintang">
                                            <?php
                                            for($i=0; $i<=5; $i++){
                                                if($i==1){
                                                    $value="1";
                                                    $salue="*";
                                                }else if($i==2){
                                                    $value="2";
                                                    $salue="**";
                                                }else if($i==3){
                                                    $value="3";
                                                    $salue="***";
                                                }else if($i==4){
                                                    $value="4";
                                                    $salue="****";
                                                }else if($i==5){
                                                    $value="5";
                                                    $salue="*****";
                                                }
                                                
                                                if($ngisi['bintang'] == $value){
                                                    $sel= "selected";
                                                }else{
                                                    $sel= "";
                                                }
                                                echo "<option value='$value' $sel>$salue</option>";
                                            }
                                            ?>
                                        </select>
                                	</div>
                                    	<label>Harga Sewa Penginapan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">Rp</span>
                            			<input class="form-control" name="harga" type="text" value="<?php echo $ngisi['harga']; ?>">
                                        <span class="input-group-addon">,00</span>
                                	</div>
								</div>
																
                                <div class="col-lg-8">
                                    <div class="form-group">
                                    	<label>Description</label>
                            			<textarea class="form-control" name="ket_hotel"><?php echo $ngisi['ket_hotel']; ?></textarea>
                                  	</div>
                                    <?php
                                        if (isset($_GET['id'])){
                                    ?>
                                	<div class="btn-group">
                                    <input name="Tambah" type="submit" value="Tambah" class="btn" disabled>
                                    </div>
                                	<div class="btn-group">
                                    <input name="Edit" type="submit" value="Ubah" class="btn btn-info" data-hint="Klik untuk Hapus Penginapan">
                                    <input name="Delete" type="submit" value="Hapus" class="btn btn-danger" data-hint="Klik untuk Edit Penginapan">
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="btn-group">
                                    <input name="Tambah" type="submit" value="Tambah" class="btn btn-success" data-hint="Klik untuk Tambah Penginapan">
                                    </div>
                                	<div class="btn-group">
                                    <input name="Edit" type="submit" value="Ubah" class="btn" disabled>
                                    <input name="Delete" type="submit" value="Hapus" class="btn" disabled>
                                    </div>
                                    <?php
                                        }
                                    ?>
                             	</div>
								
								<div class="col-lg-4">
									<label>Aturan Input Penginapan</label>
									<div class="well">
										<small>
											1. Pilih Daerah dimana penginapan berada<br />
											2. Pengisian Nama Penginapan
											<ul>
												<li>Format : Nama Penginapan (class room) lama menginap</li>
												<li>Contoh : Hotel Penginapan (Delux) 1H</li>
												<li>Class Room : Standar, Superior, Delux, Suite Keluarga (Domestik)</li>
												<li>Lama Menginap : 1H, 2H, 3H, ...</li>
											</ul>
										</small>
									</div>
								</div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row col-lg-10">
                        	<table class="table table-hover table-striped" id="dataTables-hotel">
                                <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">Nama Daerah</th>
                                        <th class="text-left">Nama Hotel</th>
                                        <th class="text-left">Bintang</th>
                                        <th class="text-left">Harga</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
									$no=1;
									$comot=mysqli_query($kon,"select * from tbl_hotel,tbl_daerah WHERE tbl_hotel.kd_daerah=tbl_daerah.kode");
									while($isi_tbl=mysqli_fetch_array($comot)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td><td><?php echo $isi_tbl['daerah']; ?></td>
                                        <td><?php echo $isi_tbl[2]; ?></td>
                                        <td><?php echo $isi_tbl[3]; ?></td>
                                        <td><?php echo $isi_tbl[4]; ?> IDR</td>
                                        <td class="text-right">
                                        <div class="tooltip-demo">
                                            <a href="setupHotel.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-primary btn-xs"data-toggle="tooltip" data-placement="top" title="Edit/Hapus Penginapan"><i class="fa fa-wrench"></i></button></a>
                                   		</div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                                
                            </table>
                        </div>
					</div>
                    
                </div>
                <!--.panel end -->
			</div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- Page-Level Plugin Scripts - Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script>
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>
	<script>
    $(document).ready(function() {
        $('#dataTables-hotel').dataTable();
    });
    </script>
    <!-- tinyMCE-->
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
    tinymce.init({
            selector: "textarea",
            plugins: [
                    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons template textcolor paste textcolor "
            ],
    
            toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
            toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor code | inserttime preview | forecolor backcolor",
            toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks restoredraft",
    
            menubar: false,
            toolbar_items_size: 'small',
            image_advtab: true,
            style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
    });</script>
	
</body>

</html>
<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login');
}
?>