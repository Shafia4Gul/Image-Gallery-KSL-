<?php
	session_start();
	
		if(!isset($_SESSION["upassword"])){
	
		header("Location: loginForm.php?msg=Direct Access in Unauthorized");
	}
?>

<?php

include("includes/dbconfig.php");

$lemail = $_SESSION["email"];
$user_id= $_SESSION['uid']; 
$lpassword = $_SESSION["upassword"];
$sql1="delete from profile_image where  user_id='$user_id'";
if( !mysqli_query($con,$sql1));
{
	//session_destroy();
	header ("Location: deleteAccount1.php?msg=Account Deleted successfully");
}	




?>