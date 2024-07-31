<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level		=$_SESSION['level'];
	
	if(isset($_POST['Tambah']))
	{
		mysqli_query($kon,"INSERT INTO tbl_daerah (kode, daerah)
				value ('$_POST[kode]','$_POST[daerah]')") or die(mysqli_error());
	}
	
	else if(isset($_POST['Edit']))
	{
		mysqli_query($kon,"UPDATE tbl_daerah SET kode = '$_POST[kode]', daerah = '$_POST[daerah]' WHERE id_daerah = '$_POST[id]'");
	}
	
	else if(isset($_POST['Delete']))
	{
		mysqli_query($kon,"DELETE FROM tbl_daerah WHERE id_daerah = '$_POST[id]'");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Daerah</title>
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
                    <div class="panel-heading"><h3>Setup Daerah Tujuan Wisata</h3></div>
                    <div class="panel-body">
                        <div class="row col-lg-6">
                        	<form name="setupDaerah" action="setupDaerah.php" method="post" enctype="multipart/form-data">
							<?php
                                if (isset($_GET['id']))
                                {
                                $comot_id=mysqli_query($kon,"select * from tbl_daerah where id_daerah=".$_GET['id']);   
                                $ngisi=mysqli_fetch_array($comot_id);
                                }	                     
                            ?>
                                <fieldset>
									<input name="id" type="hidden" value="<?php echo $ngisi['id_daerah']; ?>">
                                	<div class="form-group">
                                    	<label>Kode Daerah</label>
                            			<input class="form-control" name="kode" type="text" placeholder="Input kode daerah" value="<?php echo $ngisi['kode']; ?>">
                                    </div>
                                	<div class="form-group">
                                    	<label>Nama Daerah</label>
                            			<input class="form-control" name="daerah" type="text" placeholder="Input nama daerah" value="<?php echo $ngisi['daerah']; ?>">
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
                                        <th class="text-left fg-white">Kode Daerah</th>
                                        <th class="text-left fg-white">Nama Daerah</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
									$no=1;
									$comot=mysqli_query($kon,"select * from tbl_daerah");
									while($isi_tbl=mysqli_fetch_array($comot)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $isi_tbl['kode']; ?></td>
                                        <td><?php echo $isi_tbl['daerah']; ?></td>
                                        <td class="text-right">
                                        <div class="tooltip-demo">
                                            <a href="setupDaerah.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-primary btn-xs"data-toggle="tooltip" data-placement="top" title="Edit/Hapus Daerah"><i class="fa fa-wrench"></i></button></a>
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