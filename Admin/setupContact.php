<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level		=$_SESSION['level'];
	
	if(isset($_POST['Tambah']))
	{
		mysqli_query($kon,"INSERT INTO contact (alamat, kota, no_hp, no_tlp, email, content)
				value ('$_POST[alamat]','$_POST[kota]','$_POST[no_hp]','$_POST[no_tlp]','$_POST[email]','$_POST[content]')")
				or die(mysqli_error($kon));
	}
	
	else if(isset($_POST['Edit']))
	{
		mysqli_query($kon,"UPDATE contact SET alamat = '$_POST[alamat]', kota = '$_POST[kota]', no_hp = '$_POST[no_hp]', no_tlp = '$_POST[no_tlp]', email = '$_POST[email]', content = '$_POST[content]' WHERE id = '$_POST[id]'");
	
	}
	
	else if(isset($_POST['Delete']))
	{
		mysqli_query($kon,"DELETE FROM contact WHERE id = '$_POST[id]'");
	
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Contact</title>
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
                    <div class="panel-heading"><h3>Setup Contact</h3></div>
                    <div class="panel-body">
                        <form name="setupContact" action="setupContact.php" method="post" enctype="multipart/form-data">
                        <?php
                            $ngisi = array_fill(0, 7, ''); // Initialize $ngisi with empty values
                            if (isset($_GET['id']))
                            {
                            $comot_id=mysqli_query($kon,"select * from contact where id=".$_GET['id']);   
                            $ngisi=mysqli_fetch_row($comot_id);
                            }
                                                 
                        ?>
                            <fieldset>
                                <div class="row">
                                <div class="col-lg-4">
                                <input name="id" type="hidden" value="<?php echo $ngisi[0]; ?>">
                                <div class="form-group">
                                    <label>Email</label>
                            		<input class="form-control" name="email" type="text" placeholder="Input email" value="<?php echo $ngisi[5]; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input class="form-control" name="kota" type="text" placeholder="Input Kota" value="<?php echo $ngisi[2]; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="2"><?php echo $ngisi[1]; ?></textarea>
                                </div>
                                </div>
                                
                                <div class="col-lg-4">
                                <div class="form-group">
                                <div class="form-group">
                                    <label>Handphone</label>
                                    <input class="form-control" name="no_hp" type="text" placeholder="Input nomor handphone" value="<?php echo $ngisi[3]; ?>">
                                </div>
                                    <label>Telepon</label>
                            		<input class="form-control" name="no_tlp" type="text" placeholder="Input nomor telepon" value="<?php echo $ngisi[4]; ?>">
                                </div>
                                <div class="form-group">
                                    <label>More Description</label>
									<textarea name="content"><?php echo $ngisi[6]; ?></textarea>
                                </div>
                                </div>
                                </div>
                                
                                <?php
                                    if (isset($_GET['id'])){
                                ?>
                                <div class="btn-group">
                                <input name="Tambah" type="submit" value="Tambah" class="btn" disabled>
                                </div>
                                <div class="btn-group">
                                <input name="Edit" type="submit" value="Ubah" class="btn btn-info" data-hint="Klik untuk Hapus Post">
                                <input name="Delete" type="submit" value="Hapus" class="btn btn-danger" data-hint="Klik untuk Edit Post">
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
                    
                    <div class="panel-body">
                        <div class="row col-lg-10">
                        	<table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">Handphone</th>
                                        <th class="text-left">Telepon</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
									$no=1;
                                    $comot=mysqli_query($kon,"select * from contact order by id");
									while($isi_tbl=mysqli_fetch_row($comot)){
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $isi_tbl[3]; ?></td>
                                        <td><?php echo $isi_tbl[4]; ?></td>
                                        <td><?php echo $isi_tbl[5]; ?></td>
                                        <td class="text-right">
                                        <div class="tooltip-demo">
                                            <a href="setupContact.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-primary btn-xs"data-toggle="tooltip" data-placement="top" title="Edit/Hapus Contact"><i class="fa fa-wrench"></i></button></a>
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
	<!-- tinyMCE-->
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
    tinymce.init({
      	selector: "textarea",

        toolbar1: "bold italic underline | cut copy paste | undo redo",
		
		menubar: false,
		toolbar_items_size: 'small',
    });</script>
</body>

</html>
<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login');
}
?>