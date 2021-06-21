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
$sql="delete from user_info where email='$lemail' and id=$user_id";
if( !mysqli_query($con,$sql));
{

	session_destroy();
	header ("Location: loginForm.php?msg=Account Deleted successfully");
}



?>