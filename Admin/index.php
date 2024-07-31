<?php  session_start();

include "../config/koneksi.php";

if (isset($_POST['Login'])){
	//koneksi terpusat

	$username=$_POST['user_admin'];
	$password=$_POST['pass_admin'];
	$level=$_POST['level'];
	
	if($level=="admin"){
		$query=mysqli_query($kon,"select * from tbl_admin where user_admin='$username' and pass_admin='$password' and aktif='Y' and level='$level'");
		$cek=mysqli_num_rows($query);
		
		if($cek){
			$_SESSION['user_admin']=$username;
			$_SESSION['pass_admin']=$password;
			$_SESSION['level']=$level;
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login";</script><?php
		}	
	}
	
	if($level=="operator"){
		$query=mysqli_query($kon,"select * from tbl_admin where user_admin='$username' and pass_admin='$password' and aktif='Y' and level='$level'");
		$cek=mysqli_num_rows($query);
		
		if($cek){
			$_SESSION['user_admin']=$username;
			$_SESSION['pass_admin']=$password;
			$_SESSION['level']=$level;
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login";</script><?php
		}	
	}
	
}else{
	unset($_POST['Login']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator</title>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body style="background-image:url(4k.jpg);background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="loginAdmin" method="post" action="#">
                            <fieldset>
                            	<?php  
									if(isset($_GET['status'])){
								?>
                                <div class="alert alert-danger text-center"><span class="glyphicon glyphicon-warning-sign"></span><?php echo " &nbsp;".$_GET['status']."";?></div>
                                <?php }?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="user_admin" type="text" autofocus required>
                             	</div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pass_admin" type="password" required>
                                </div>
                                <div class="form-group">
                                	<select name="level" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="operator">Operator</option>
                                    </select>
								</div>
                                <div class="form-group">
                                    <input class="btn btn-lg btn-success btn-block" name="Login" type="submit" value="Submit">
                                </div>
                            </fieldset>
                        </form>
                        <hr>
                        <center>Distributed by <a href="https://blogbugabagi.blogspot.com" target="_blank" rel="noopener noreferrer">BlogBugaBagi</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

</body>
</html>