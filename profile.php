<?php
	session_start();
	include("includes/dbconfig.php");
	include 'functions.php';
	$ui_id=$_SESSION["uid"];
?>
<?php
		if(!isset($_SESSION["upassword"])){
	
		header("Location: loginForm.php?msg=Direct Access in Unauthorized");
	}
?>

<!doctype html>
<html lang="en">
<head>
	<title>My profile</title>
	<?=template_header('Gallery')?>
</head>
<body>
<div class="content home">

	<h2>MY PROFILE</h2>
	<span style="color:red;text-align:center;"><?php if(isset($_GET["msg"])) {echo $_GET["msg"];} ?> </span>

	<table width="100%">

	<td><?php
	$user_id=$_SESSION["uid"];
	$profile_image="";
 	$con= mysqli_connect("localhost","root","");
 	$db = mysqli_select_db($con,'bsse');

 	$query ="SELECT * FROM `profile_image` where user_id=$user_id";
 	$query_run= mysqli_query($con,$query);

 	while($row = mysqli_fetch_array($query_run)){

 		$profile_image= '<img src="'.($row['path']).'"  alt="Image" style="width: 200px; height: 200px;" >';
 	}
	echo $profile_image;
 	?>
 </td>

	  
	  
	</tr>
	<tr>
	
	<table width="50%">
		<tr>
			<td>	  	
			<form action="uploadProfile.php" method="POST" enctype="multipart/form-data">
			<input type="submit" value="Upload Profile Image" name="upload" class="btn btn-primary">
			</form> 
			</td>
		</tr>
		<tr>
			<td><label>Name:</label></td>
			<td><?php echo $_SESSION['name']; ?></td>
		</tr>
		<tr>
			<td><label>Email:</label></td>
			<td><?php echo $_SESSION['email']; ?></td>
		</tr>
		<tr>
			<td><label>DOB:</label></td>
			<td><?php echo $_SESSION['dob']; ?></td>
		</tr>
		<tr>
			<td><label>Gender:</label></td>
			<td><?php echo $_SESSION['gender']; ?></td>

	</table>
	</tr>
 
</table>    
</div>
  </body>
</html>