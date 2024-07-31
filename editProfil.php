<?php session_start();

if(isset($_SESSION['username'])){

	//koneksi terpusat
	include "config/koneksi.php";
	$username=$_SESSION['username'];
	
	if(isset($_POST['Edit']))
	{
		mysqli_query($kon, "UPDATE tbl_user SET nama_user='$_POST[nama]', no_hp='$_POST[no_hp]', no_rek='$_POST[no_rek]', nama_rek='$_POST[nama_rek]', tgl_lahir='$_POST[tgl_lahir]', jekel='$_POST[jekel]', alamat='$_POST[alamat]', email_user='$_POST[email]', tipe_id='$_POST[tipe_id]', no_id='$_POST[no_id]' WHERE id_user= '$_POST[id_user]'");
	
		header('location:profil.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="css/iconFont.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">

    <!-- Load JavaScript Libraries -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.widget.min.js"></script>
    <script src="js/jquery/jquery.mousewheel.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="js/load-metro.js"></script>
    <script src="js/docs.js"></script>
    
    <style>
    </style>

<title>Edit Profil</title>
</head>


<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="sampul.html"></div>
	<script type="text/javascript" src="admin/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
			selector: "textarea",

			toolbar1: "undo redo | cut copy paste | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify",
			
			menubar: false,
			toolbar_items_size: 'small',
	});</script>
	
<?php
	$query	=mysqli_query($kon, "SELECT * FROM tbl_user WHERE username='$username'");
	$tampil	=mysqli_fetch_array($query);
?>
    
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container">
        <div class="grid">
			<form name="editProfil" method="post" action="#">
			<div class="row">
				<div class="span6">
                    <fieldset>
                        <legend class="text-right">Edit</legend>
                        <lable>Nama Lengkap</lable>
                        <div class="input-control text" data-role="input-control">
							<input type="hidden" name="id_user" readonly
							 value="<?php echo $tampil['id_user'];?>">
                            <input type="text" name="nama"
							 value="<?php echo $tampil['nama_user'];?>">
							<button class="btn-clear" tabindex="-1"></button>
                        </div>
						<lable>Nomor Handphone</lable>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" name="no_hp"
							 value="<?php echo $tampil['no_hp'];?>">
							<button class="btn-clear" tabindex="-1"></button>
                        </div>
						<lable>Tanggal Lahir</lable>
                        <div class="input-control text" data-role="input-control">
                            <div class="input-control text" data-role="datepicker" data-format="dd mmmm yyyy" data-effect="fade">
								<input type="text" name="tgl_lahir"
								 value="<?php echo $tampil['tgl_lahir'];?>">
								<span class="btn-date"></span>
                            </div>
                        </div>
						<lable>Jenis Kelamin</lable>
						<div>
						<?php
							if($tampil['jekel']=='L'){
								$l= "checked"; $p="";
							}else if($tampil['jekel']=='P'){
								$l= ""; $p="checked";
							}else{
								$l= ""; $p="";
							}
						?>
							<div class="input-control radio" data-role="input-control">
								<label>
									<input type="radio" name="jekel" value="L" <?php echo $l ?> />
                                    <span class="check"></span>
                                    Laki-laki
                                </label>
                            </div>
                            <div class="input-control radio" data-role="input-control">
								<label>
									<input type="radio" name="jekel" value="P" <?php echo $p ?> />
                                    <span class="check"></span>
                                    Perempuan
                                </label>
                            </div>
                        </div>
						<lable>Nomor Rekening</lable>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" name="no_rek"
							 value="<?php echo $tampil['no_rek'];?>">
							<button class="btn-clear" tabindex="-1"></button>
                        </div>
						<lable>Atas Nama Rekening</lable>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" name="nama_rek"
							 value="<?php echo $tampil['nama_rek'];?>">
							<button class="btn-clear" tabindex="-1"></button>
                        </div>
						<label>Alamat</label>
                        <div class="input-control textarea" data-role="input-control">
                            <textarea name="alamat" rows="2"><?php echo $tampil['alamat']; ?></textarea>
						</div>
					</fieldset>	
				</div>
				<div class="span6">
                    <fieldset>
                        <legend>Profil</legend>
                        <lable>Email</lable>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" name="email"
							 value="<?php echo $tampil['email_user'];?>">
							<button class="btn-clear" tabindex="-1"></button>
                        </div>
						<lable>Tipe Identitas</lable>
                        <div class="input-control select" data-role="input-control">
                            <select name="tipe_id">
								<?php
								for($i=1; $i<=4; $i++){
									if($i==1){
										$value="KTP";
									}else if($i==2){
										$value="SIM";
									}else if($i==3){
										$value="Pasport";
									}else if($i==4){
										$value="Kartu Pelajar";
									}
									
									if($tampil['tipe_id']==$value){
										$sel= "selected";
									}else{
										$sel= "";
									}
									
									echo "<option value='$value' $sel>$value</option>";
								}?>
							</select>
                        </div>
						<lable>Nomor Identitas</lable>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" name="no_id"
							 value="<?php echo $tampil['no_id'];?>">
							<button class="btn-clear" tabindex="-1"></button>
                        </div>
					</fieldset>	
				</div>
				
			</div>
			<input type="submit" name="Edit" value="Simpan Perubahan">
			</form>
        </div>
    </div>
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    
    <footer class="dark" data-load="bawahan.html"></footer>
</body>
</html>
<?php
}else{
	session_destroy();
	header('Location:formRegistrasi.php?status=Silahkan Login');
}
?>