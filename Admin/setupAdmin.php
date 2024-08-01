<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level	=$_SESSION['level'];
		
	if(isset($_POST['Tambah']))
	{
		$nama=ucwords(strtolower($_POST['nama']));
		mysqli_query($kon,"INSERT INTO tbl_admin (user_admin, pass_admin, level, aktif, nama)
				value ('$_POST[user]','$_POST[pass]','$_POST[level]','$_POST[status]','$nama')") or die(mysqli_error($kon));
	}
	else if(isset($_POST['Edit'])){
		$nama=ucwords(strtolower($_POST['nama']));
		mysqli_query($kon,"UPDATE tbl_admin SET pass_admin='$_POST[pass]', level='$_POST[level]', aktif='$_POST[status]', nama='$nama' WHERE user_admin= '$_POST[user]'");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Admin</title>
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
                    <div class="panel-heading"><h3>Setup Admin</h3></div>
                    <div class="panel-body">   
                        <form name="setupAdmin" action="setupAdmin.php" method="post" enctype="multipart/form-data">
                        <?php
                            $ngisi = ['user_admin' => '', 'pass_admin' => '', 'nama' => '', 'level' => '', 'aktif' => ''];
                            if (isset($_GET['user']))
                            {
                            $comot_id = mysqli_query($kon,"SELECT * FROM tbl_admin WHERE user_admin='".$_GET['user']."'");   
                            $ngisi = mysqli_fetch_array($comot_id);
                            }                       
                        ?>
                        <fieldset>
                        	<div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="user" type="text" value="<?php echo $ngisi['user_admin']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="pass" type="text" value="<?php echo $ngisi['pass_admin']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" name="nama" type="text" value="<?php echo $ngisi['nama']; ?>" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Level Akses</label>
                                    <select class="form-control" name="level">
                                    	<?php
                                        for($i=1; $i<=2; $i++){
											if($i==1){
												$value="admin";
												$salue="Administrator";
											}else if($i==2){
												$value="operator";
												$salue="Operator";
											}
											
											if($ngisi['level']==$value){
												$sel= "selected";
											}else{
												$sel= "";
											}
											echo "<option value='$value' $sel>$salue</option>";
										}
										?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Admin</label>
                                    <select class="form-control" name="status">
                                    	<?php
                                        for($i=1; $i<=2; $i++){
											if($i==1){
												$value1="Y";
												$salue1="Aktif";
											}else if($i==2){
												$value1="N";
												$salue1="Tidak Aktif";
											}
											
											if($ngisi['aktif']==$value1){
												$sel= "selected";
											}else{
												$sel= "";
											}
											echo "<option value='$value1' $sel>$salue1</option>";
										}
										?>
                                    </select>
                                </div>
                       		</div>
                            </div>
                                <?php
                                    if (isset($_GET['user'])){
                                ?>
                                <div class="btn-group">
                                    <input name="Tambah" type="submit" value="Tambah" class="btn" disabled>
                                </div>
                                <div class="btn-group">
                                    <input name="Edit" type="submit" value="Ubah" class="btn btn-info">
                                </div>
                                <?php
                                    }else{
                                ?>
                                <div class="btn-group">
                                    <input name="Tambah" type="submit" value="Tambah" class="btn btn-success">
                                </div>
                                <div class="btn-group">
                                    <input name="Edit" type="submit" value="Ubah" class="btn" disabled>
                                </div>
                                <?php
                                    }
                                ?>
                            </fieldset>
                        </form>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row col-lg-10">
                        	<div class="table-responsive">
                        	<table class="table table-hover table-striped" id="dataTables-transaksi">
                                <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">Nama Lengkap</th>
                                        <th class="text-left">Username</th>
                                        <th class="text-left">Password</th>
                                        <th class="text-left">Level</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
									$no=1;
                                    $comot=mysqli_query($kon,"SELECT * FROM tbl_admin ORDER BY level");
                                    while($isi_tbl=mysqli_fetch_array($comot))
                                    {
                                ?>
                                    <tr>
                                        <td><?php echo $no++?></td>
                                        <td><?php echo $isi_tbl['nama']; ?></td>
                                        <td><?php echo $isi_tbl['user_admin']; ?></td>
                                        <td><?php echo $isi_tbl['pass_admin']; ?></td>
                                        <td><?php echo $isi_tbl['level']; ?></td>
                                        <td><?php echo $isi_tbl['aktif']; ?></td>
                                        <td class="text-right">
                                        <div class="tooltip-demo">
                                            <a href="setupAdmin.php?user=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-xs btn-primary"data-toggle="tooltip" data-placement="top" title="Edit Member"><i class="fa fa-wrench"></i></button></a>
                                            <a href="delAdmin.php?user=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-xs btn-danger"data-toggle="tooltip" data-placement="top" title="Delete Member"><i class="fa fa-trash-o"></i></button></a>
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
</body>

</html>
<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login');
}
?>