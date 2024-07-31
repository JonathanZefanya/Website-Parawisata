<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level		=$_SESSION['level'];
	
	if(isset($_POST['Tambah']))
	{
		mysqli_query($kon,"INSERT INTO tbl_paket (id_kategori, nama_paket, harga_paket, ket_paket)
				value ('$_POST[id_kategori]','$_POST[nama_paket]','$_POST[harga_paket]','$_POST[ket_paket]')")
				or die(mysqli_error($kon));
	}
	
	else if(isset($_POST['Edit']))
	{
		mysqli_query($kon,"UPDATE tbl_paket SET id_kategori = '$_POST[id_kategori]', nama_paket = '$_POST[nama_paket]', harga_paket = '$_POST[harga_paket]', ket_paket = '$_POST[ket_paket]' WHERE id_paket = '$_POST[id]'");
	
	}
	
	else if(isset($_POST['Delete']))
	{
		mysqli_query($kon,"DELETE FROM tbl_paket WHERE id_paket = '$_POST[id]'");
	
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Paket</title>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
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
            <div class="row col-lg-12">
                
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Setup Paket</h3></div>
                    <div class="panel-body">
                        <div class="row col-lg-6">
                        	<form name="setupPaket" action="setupPaket.php" method="post" enctype="multipart/form-data">
							<?php
                                $ngisi = array('id_kategori' => '', 'nama_paket' => '', 'harga_paket' => '', 'ket_paket' => '');
                                if (isset($_GET['id']))
                                {
                                $comot_id=mysqli_query($kon,"select * from tbl_paket where id_paket=".$_GET['id']);   
                                $ngisi=mysqli_fetch_array($comot_id);
                                }
                                                     
                            ?>
                                <fieldset>
									<input name="id" type="hidden" value="<?php echo $ngisi[0]; ?>">
                                	<div class="form-group">
                                    	<label>Pilih Kategori</label>
                            			<select class="form-control" name="id_kategori">
											<?php 
                                                $comot_kat = mysqli_query($kon,"SELECT * FROM tbl_kategori");
                                                while ($ngisi_kat = mysqli_fetch_assoc ($comot_kat)){
                                                    if($ngisi_kat['id_kategori'] == $ngisi['id_kategori']){
                                                        echo "<option value='$ngisi_kat[id_kategori]' selected>$ngisi_kat[kategori]</option>";
                                                    }else{
                                                        echo "<option value='$ngisi_kat[id_kategori]'>$ngisi_kat[kategori]</option>";						
                                                    }
                                                    
                                                }
                                            ?>
                                        </select>
                            		</div>
                                    <div class="form-group">
                                    	<label>Nama Paket</label>
                            			<input class="form-control" name="nama_paket" type="text" placeholder="Input nama paket" value="<?php echo $ngisi['nama_paket']; ?>">
                            		</div>
                                    	<label>Nama Paket</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">Rp</span>
                            			<input class="form-control" name="harga_paket" type="text" value="<?php echo $ngisi['harga_paket']; ?>">
                                        <span class="input-group-addon">,00</span>
                            		</div>
                                	<div class="form-group">
                                    	<label>Description</label>
                            			<textarea class="form-control" name="ket_paket"><?php echo $ngisi['ket_paket']; ?></textarea>
                            		</div>
                                    <?php
                                        if (isset($_GET['id'])){
                                    ?>
                                	<div class="btn-group">
                                    <input name="Tambah" type="submit" value="Tambah" class="btn" disabled>
                                    </div>
                                	<div class="btn-group">
                                    <input name="Edit" type="submit" value="Ubah" class="btn btn-info" data-hint="Klik untuk Hapus Daerah">
                                    <input name="Delete" type="submit" value="Hapus" class="btn btn-danger" data-hint="Klik untuk Edit Daerah">
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="btn-group">
                                    <input name="Tambah" type="submit" value="Tambah" class="btn btn-success" data-hint="Klik untuk Tambah Post">
                                    </div>
                                	<div class="btn-group">
                                    <input name="Edit" type="submit" value="Ubah" class="btn" disabled>
                                    <input name="Delete" type="submit" value="Hapus" class="btn" disabled>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row col-lg-10">
                        	<table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">Kategori</th>
                                        <th class="text-left">Nama Paket</th>
                                        <th class="text-left">Harga</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
									$no=1;
									$comot=mysqli_query($kon,"select * from tbl_paket,tbl_kategori where tbl_paket.id_kategori=tbl_kategori.id_kategori order by tbl_paket.id_kategori");
									while($isi_tbl=mysqli_fetch_array($comot))
									{
								?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $isi_tbl['kategori']; ?></td>
                                        <td><?php echo $isi_tbl['nama_paket']; ?></td>
                                        <td><?php echo $isi_tbl['harga_paket']; ?> IDR</td>
                                        <td class="text-right">
                                        <div class="tooltip-demo">
                                            <a href="setupPaket.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-primary btn-xs"data-toggle="tooltip" data-placement="top" title="Edit/Hapus Paket"><i class="fa fa-wrench"></i></button></a>
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
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    <script>
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>
	
</body>

</html>
<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login');
}
?>