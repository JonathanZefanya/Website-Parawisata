<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level	=$_SESSION['level'];
		
	if(isset($_POST['Edit'])){
		mysqli_query($kon,"UPDATE tbl_pesan SET status='$_POST[status]' WHERE id_pesan = '$_POST[id]'");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Member</title>
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
            <div class="row col-lg-12">
                
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Setup Member</h3></div>
                    <div class="panel-body">   
                        <form name="setupMember" action="setupMember.php" method="post" enctype="multipart/form-data">
                        <?php
                            if (isset($_GET['id']))
                            {
                            $comot_id=mysqli_query($kon,"SELECT * FROM tbl_user WHERE id_user=".$_GET['id']);   
                            $ngisi=mysqli_fetch_array($comot_id);
                            }                       
                        ?>
                        <fieldset>
                        	<div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ID Member</label>
                                    <input class="form-control" size="1" name="id" type="text" value="<?php echo $ngisi['id_user']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" type="text" value="<?php echo $ngisi['username']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="text" value="<?php echo $ngisi['password']; ?>" >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Nama Member</label>
                                    <input class="form-control" name="nama_user" type="text" value="<?php echo $ngisi['nama_user']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" name="email" type="email" value="<?php echo $ngisi['email_user']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Handphone</label>
                                    <input class="form-control" name="no_hp" type="text" value="<?php echo $ngisi['no_hp']; ?>" >
                                </div>
                       		</div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input class="form-control" name="jekel" type="text" value="<?php echo $ngisi['jekel']; ?>" >
                                </div>
                                <div class="form-group">
                                  <label>Alamat Member</label>
                                    <textarea name="alamat" rows="1" class="form-control" ><?php echo $ngisi['alamat']; ?></textarea>
                                </div>
                       		</div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" name="tgl_lahir" type="text" value="<?php echo $ngisi['tgl_lahir']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>No. Rekening</label>
                                    <input class="form-control" name="no_rek" type="text" value="<?php echo $ngisi['no_rek']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Rekening atas Nama</label>
                                    <input class="form-control" name="nama_rek" type="text" value="<?php echo $ngisi['nama_rek']; ?>" >
                                </div>
                       		</div>
                            </div>
                                <?php
                                    if (isset($_GET['id'])){
                                ?>
                                <input name="Edit" type="submit" value="Ubah" class="btn btn-info btn-block">
                                <?php
                                    }else{
                                ?>
                                <input name="Edit" type="submit" value="Ubah" class="btn btn-block" disabled>
                                <?php
                                    }
                                ?>
                            </fieldset>
                        </form>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row col-lg-13">
                        	<div class="table-responsive">
                        	<table class="table table-hover table-striped" id="dataTables-transaksi">
                                <thead>
                                    <tr>
                                        <th class="text-left">ID</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Handphone</th>
                                        <th class="text-left">Rekening</th>
                                        <th class="text-left">Tgl Lahir</th>
                                        <th class="text-left">Jekel</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
                                    $comot=mysqli_query($kon,"SELECT * FROM tbl_user");
                                    while($isi_tbl=mysqli_fetch_array($comot))
                                    {
                                ?>
                                    <tr>
                                        <td><?php echo $isi_tbl['id_user'] ?></td>
                                        <td><div class="tooltip-demo"><span data-toggle="tooltip" data-placement="top" title="[<?php echo $isi_tbl['tipe_id']; ?>] <?php echo $isi_tbl['no_id']; ?>">
										<?php echo $isi_tbl['nama_user']; ?></span>
										</div></td>
                                        <td><?php echo $isi_tbl['email_user']; ?></td>
                                        <td><?php echo $isi_tbl['no_hp']; ?></td>
                                        <td><?php echo $isi_tbl['no_rek']; ?> a/n <?php echo $isi_tbl['nama_rek']; ?></td>
                                        <td><?php echo $isi_tbl['tgl_lahir']; ?></td>
                                        <td><?php echo $isi_tbl['jekel']; ?></td>
                                        <td>
                                        <div class="tooltip-demo">
                                            <a href="setupMember.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit Member"><i class="fa fa-wrench"></i></button></a>
                                            <a href="delMember.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Member"><i class="fa fa-trash-o"></i></button></a>
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
                    <div class="panel-footer">Ismo</div>

                    
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
        $('#dataTables-transaksi').dataTable();
    });
    </script>
    <!-- tinyMCE-->
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
    tinymce.init({
      	selector: "textarea",

        toolbar1: "bold italic underline | cut copy paste",
		
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