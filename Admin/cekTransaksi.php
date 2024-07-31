<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level		=$_SESSION['level'];
		
	if(isset($_POST['Edit'])){
		mysqli_query($kon,"UPDATE tbl_pesan SET status='$_POST[status]' WHERE id_pesan = '$_POST[id]'");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Transaksi</title>
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
                    <div class="panel-heading"><h3>Cek Transaksi</h3></div>
                    <div class="panel-body">   
                        <form name="cekTransaksi" action="cekTransaksi.php" method="post" enctype="multipart/form-data">
                        <?php
                            if (isset($_GET['id']))
                            {
                            $comot_id=mysqli_query($kon,"SELECT * FROM tbl_pesan WHERE id_pesan=".$_GET['id']);   
                            $ngisi=mysqli_fetch_array($comot_id);
                            if ($ngisi==null){
                                echo "NULL";
                            }              
                            }         
                        ?>
                        <fieldset>
                        	<div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>ID Pesan</label>
                                    <input class="form-control" name="id" type="text" value="<?php echo $ngisi['id_pesan']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                    	<?php
                                        for($i=0; $i<=4; $i++){
											if($i==1){
												$value="S1";
												$salue="Menunggu";
											}else if($i==2){
												$value="S2";
												$salue="Lunas";
											}else if($i==3){
												$value="S3";
												$salue="Bayar diTempat";
											}else if($i==4){
												$value="S4";
												$salue="Telah Tour";
											}else{
												$value="";
												$salue="-- Pilih --";
											}
											
											if($ngisi['status']==$value){
												$sel= "selected";
											}else{
												$sel= "";
											}
											echo "<option value='$value' $sel>$salue</option>";
										}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Tour</label>
                                    <input class="form-control" name="tgl_tour" type="text" value="<?php echo $ngisi['tgl_tour']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pesan</label>
                                    <input class="form-control" name="tgl_tour" type="text" value="<?php echo $ngisi['tgl_pesan']; ?>" readonly>
                                </div>
                       		</div>
                            </div>
                                <?php
                                    if (isset($_GET['id'])){
                                ?>
                                <input name="Edit" type="submit" value="Ubah" class="btn btn-info" data-hint="Klik untuk Edit Post">
                                </div>
                                <?php
                                    }else{
                                ?>
                                <input name="Edit" type="submit" value="Ubah" class="btn" disabled>
                                </div>
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
                                        <th class="text-left">Tgl Pesan</th>
                                        <th class="text-left">Tgl Tour</th>
                                        <th class="text-left">Nama Pelanggan</th>
                                        <th class="text-left">Nama Paket</th>
                                        <th class="text-left">Nama Penginapan</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
                                    $comot=mysqli_query($kon,"SELECT * FROM tbl_pesan, tbl_paket, tbl_hotel, tbl_user WHERE
														tbl_pesan.id_user=tbl_user.id_user AND tbl_pesan.id_paket=tbl_paket.id_paket AND 
														tbl_pesan.id_hotel=tbl_hotel.id_hotel");
                                    while($isi_tbl=mysqli_fetch_array($comot))
                                    {
									$total_harga	=$isi_tbl['harga_paket']+$isi_tbl['harga'];
									$now= date("Y-m-d");
                                ?>
                                    <tr>
                                        <td><?php echo $isi_tbl['id_pesan'] ?></td>
                                        <td><?php echo $isi_tbl['tgl_pesan']; ?></td>
                                        <td><?php
										if($isi_tbl['tgl_tour']<$now){
											$txtS="Kadaluarsa!!";
											echo "<div class='tooltip-demo'><span data-toggle='tooltip' data-placement='top' title='".$txtS."'><div class='text-danger'><i class='fa fa-warning'></i>&nbsp".$isi_tbl['tgl_tour']."</div></span></div>";
										}else{
											echo $isi_tbl['tgl_tour']; 
										}?></td>
                                        <td><?php echo $isi_tbl['nama_user']; ?></td>
                                        <td><div class="tooltip-demo"><span data-toggle="tooltip" data-placement="top" 
											title="<?php echo $isi_tbl['harga_paket']; ?> IDR">
											<?php echo $isi_tbl['nama_paket']; ?></span></div>
										</td>
                                        <td><div class="tooltip-demo"><span data-toggle="tooltip" data-placement="top" 
											title="<?php echo $isi_tbl['harga']; ?> IDR">
											<?php echo $isi_tbl['hotel']; ?></span></div>
										</td>
                                        <td><div class="tooltip-demo"><span data-toggle="tooltip" data-placement="top" 
											title="Total Harga <?php echo $total_harga; ?> IDR">
											<?php
                                        	if($isi_tbl['status']=='S1'){
												$stat="Menunggu";
											}else if($isi_tbl['status']=='S2'){
												$stat="Lunas";
											}else if($isi_tbl['status']=='S3'){
												$stat="Bayar diTempat";
											}else if($isi_tbl['status']=='S4'){
												$stat="Telah Tour";
											}else{
												$stat="";
											}
											echo $stat;
											?></span></div>
										</td>
                                        <td>
										<div class="tooltip-demo">
                                        	<a href="cekTransaksi.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit Transaksi"><i class="fa fa-wrench"></i></button></a>
                                            <a href="delTransaksi.php?id=<?php echo $isi_tbl[0]; ?>"><button type="button" class="btn btn-xs btn-danger"data-toggle="tooltip" data-placement="top" title="Delete Transaksi"><i class="fa fa-trash-o"></i></button></a>
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
                    <div class="panel-footer">WISATHAN</div>

                    
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