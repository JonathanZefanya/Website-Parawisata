<?php session_start();

if(isset($_SESSION['user_admin'])){

	//koneksi terpusat
	include "../config/koneksi.php";
	$username	=$_SESSION['user_admin'];
	$level		=$_SESSION['level'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style type="text/css"></style>

</head>

<body>

    <div id="wrapper">
		
		<?php
			if($level=='admin'){
				include"nav.php";
			}else if($level=='operator'){
				include"nav_operator.php";
			}else{
				echo "Anda tidak punya hak access!! Hayoo!! Siapa Anda??";
			}
		?>

        <div id="page-wrapper">
        	<div class="row col-lg-12">
            	<h1 class="page-header">Dashboard <?php echo $level; ?></h1>
            </div>
            
            <div class="row">
            
            <div class="col-lg-8">
            <div class="panel panel-default">
            	<div class="panel-heading">
                	<i class="fa fa-bar-chart-o fa-fw"></i> Transaksi Terkini
                </div>
                <div class="panel-body">
                	<div class="table-responsive">
                        <table class="table table-hover table-striped" id="dataTables-transaksi">
                            <thead>
                                <tr>
                                    <th class="text-left">ID</th>
                                    <th class="text-left">Tgl Pesan</th>
                                    <th class="text-left">Tgl Tour</th>
                                    <th class="text-left">Nama Pelanggan</th>
                                    <th class="text-left">Status</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                $comot=mysqli_query($kon,"SELECT * FROM tbl_pesan, tbl_paket, tbl_hotel, tbl_user WHERE tbl_pesan.id_user=tbl_user.id_user AND tbl_pesan.id_paket=tbl_paket.id_paket AND tbl_pesan.id_hotel=tbl_hotel.id_hotel ORDER BY tgl_pesan DESC LIMIT 5");
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
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                            
                        </table>
                	</div>
                </div>
            </div>
			<!------------------------------------------------------------------------------------------------>
			<div class="panel panel-default">
            	<div class="panel-heading">
                	<i class="fa fa-bar-chart-o fa-fw"></i> Bukti Pembayaran yang Ter-Upload Terkini
                </div>
                <div class="panel-body">
                	<div class="table-responsive">
                        <table class="table table-hover table-striped" id="dataTables-transaksi">
                            <thead>
                                <tr>
                                    <th class="text-left">#</th>
                                    <th class="text-left">ID Pesan</th>
                                    <th class="text-left">Nama</th>
                                    <th class="text-left">File</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
								$no=1;
								
                                $comot_bukti=mysqli_query($kon,"SELECT * FROM tbl_bukti, tbl_pesan, tbl_user WHERE 
													tbl_bukti.id_pesan	= tbl_pesan.id_pesan AND
													tbl_pesan.id_user	= tbl_user.id_user");
                                while($isi_bukti=mysqli_fetch_array($comot_bukti)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $isi_bukti['id_pesan']; ?></td>
                                    <td><?php echo $isi_bukti['nama_user']; ?></td>
                                    <td><a href="../images/<?php echo $isi_bukti['file'];?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                            
                        </table>
                	</div>
                </div>
            </div>
            </div>
            
            <div class="col-lg-4">
            <div class="panel panel-default">
            	<div class="panel-heading">
                	<i class="fa fa-comments-o fa-fw"></i> Komentar Terbaru
                </div>
                <div class="panel-body">
                   	<?php
					$comot_comen=mysqli_query($kon,"SELECT * FROM komentar ORDER BY waktu DESC LIMIT 3");
					while($isi_comen=mysqli_fetch_array($comot_comen))
					{ ?>
					<div class="well">
						<b><?php echo $isi_comen['nama']; ?></b>, <small><?php echo $isi_comen['waktu']; ?></small><br />
						<?php echo $isi_comen['komentar']; ?>
					</div>
					<?php
              		 }?>
                
                </div>
            </div>
            </div>
			
			<div class="col-lg-8">
            
            </div>
            
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>
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