<?php session_start();

if(isset($_SESSION['user_admin'])){
	include "../config/koneksi.php";
	$username=$_SESSION['user_admin'];
		
		mysqli_query($kon,"DELETE FROM tbl_user WHERE id_user =".$_GET['id']); 
	
	header ("location:setupMember.php");
}
?>