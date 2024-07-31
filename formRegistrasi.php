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

<title>Login</title>
</head>

<?php  session_start();

include "config/koneksi.php";

if (isset($_POST['Login'])){
	//koneksi terpusat

	$username=$_POST['username'];
	$password=$_POST['password'];
	
		$query=mysqli_query($kon,"select * from tbl_user where username='$username' and password='$password'");
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		
		if($cek){
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			
			?><script language="javascript">document.location.href="profil.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="formRegistrasi.php?status=Gagal Login";</script><?php
		}		
		

}else{
	unset($_POST['Login']);
}

if (isset($_POST['Register'])){
	//koneksi terpusat
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username)){
?>
<script>
	$(function(){
		setTimeout(function(){
			$.Notify({
				style: {background: 'red', color: 'white'}, 
				content: "Username tidah boleh kosong!!"
			}, 1000);
		});
	});
</script>
<?php
	}if(empty($password)){
?>
<script>
	$(function(){
		setTimeout(function(){
			$.Notify({
				style: {background: 'green', color: 'white'}, 
				content: "Password tidah boleh kosong!!"
			}, 2000);
		});
	});
</script>
<?php
	}else{
		$query = mysqli_query($kon,"insert into tbl_user (nama_user, email_user, username, password, jekel)
		value ('$_POST[nama]','$_POST[email]','$_POST[username]','$_POST[password]','$_POST[jekel]')");
	
		if($query){
			header("location:formRegistrasi.php?status=Anda Berhasil Register");
		
		}else{
				?><script language="javascript">document.location.href="formRegistrasi.php?status=Gagal Register";</script><?php
		}		
	}

}

?>

<body class="metro">
	<header class="bg-darkCobalt" data-load="atasan.php"></header>
    
    <div class="" data-load="slider.php"></div>
    <br />
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    <div class="container">
        <div class="grid">
        	<div class="accordion" data-role="accordion" data-closeany="true">
                <div class="accordion-frame">
                    <a class="active heading bg-darkCobalt fg-white" href="#">Log in</a>
                    <div class="content">
                        <div class="grid">
                            <div class="row">
								<div class="span7">
                                <div class="carousel " id="imgSlide">
                                    <div class="slide">
                                        <img src="images/galeri/ben2.jpg" class="cover1" />
                                    </div>

                                    <div class="slide">
                                        <img src="images/galeri/Bromo.jpg" class="cover1" />
                                    </div>

                                    <div class="slide">
                                        <img src="images/galeri/labak.png" class="cover1"/>
                                    </div>
									
									<div class="slide">
                                        <img src="images/galeri/sar2.jpg" class="cover1" />
                                    </div>
                                </div>
                                <script>
                                    $(function(){
                                        $("#imgSlide").carousel({
                                            effect: 'slide',
											period: 3000,
                                            markers: {
                                                show: false,
                                                type: 'default',
                                                position: 'bottom-right'
                                            }
                                        });
                                    })
                                </script>
								</div>
                                
                                <div class="span5 offset2">
                                    <form name="formLogin" method="post" action="formRegistrasi.php">
                                        <fieldset>
                                        	<h5><?php  if(isset($_GET['status'])){ echo "&laquo; ".$_GET['status']." &raquo;"; }?></h5>
                                            <legend>Silahkan login</legend>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="username" required="required" placeholder="Username:" autofocus>
                                                <button class="btn-clear" tabindex="-1"></button>
                                            </div>
                                            <div class="input-control password" data-role="input-control">
                                                <input type="password" name="password" required="required" placeholder="Password:">
                                                <button class="btn-reveal" tabindex="-1"></button>
                                            </div>
                                            
                                            <input type="submit" name="Login" id="Login" value="Sign in">
                                            <input type="reset" value="Cancel">
                                        </fieldset>
                                    </form>
                                </div>
                                
                            </div>
							<br/>
							<div class="balloon top">
								<div class="padding5">
									Anda belum punya Akun? Klick <strong>Sign Up</strong> dibawah!
								</div>
							</div>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-frame">
                    <a class="heading bg-darkRed fg-white" href="#">Sign Up</a>
                    <div class="content">
                        <div class="grid">
                            <div class="row">
                                
                                <div class="span6">
                                    <form name="formRegister" method="post" action="formRegistrasi.php">
                                        <fieldset>
                                        	<h5><?php  if(isset($_GET['status'])){ echo "&laquo; ".$_GET['status']." &raquo;"; }?></h5>
                                            <legend>Silahkan register di form berikut!</legend>
                                            <lable>Nama Lengkap</lable>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="nama" placeholder="masukan nama lengkap anda">
                                                <button class="btn-clear" tabindex="-1"></button>
                                            </div>
                                            <lable>Email</lable>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="email" name="email" required="required" placeholder="masukan email anda">
                                                <button class="btn-clear" tabindex="-1"></button>
                                            </div>
                                            <lable>Username</lable>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="username" placeholder="masukan username yang anda inginkan">
                                                <button class="btn-clear" tabindex="-1"></button>
                                            </div>
                                            <lable>Password</lable>
                                            <div class="input-control password" data-role="input-control">
                                                <input type="password" name="password" placeholder="masukan password yang anda inginkan" autofocus>
                                                <button class="btn-reveal" tabindex="-1"></button>
                                            </div>
                                            <lable>Jenis Kelamin</lable>
                                            <div>
                                                <div class="input-control radio" data-role="input-control">
                                                    <label>
                                                        <input type="radio" name="jekel" value="L" />
                                                        <span class="check"></span>
                                                        Laki-laki
                                                    </label>
                                                </div>
                                                <div class="input-control radio" data-role="input-control">
                                                    <label>
                                                        <input type="radio" name="jekel" value="P" />
                                                        <span class="check"></span>
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>

                                            <input type="submit" name="Register" value="Sign Up">
                                            <input type="reset" value="Cancel">
                                        </fieldset>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
    <!-- ---------------------------------------- ISI TAB ------------------------------------- -->
    
    <footer class="dark" data-load="bawahan.html"></footer>
</body>
</html>