<?php
	session_start();
	include("includes/dbconfig.php");
	include 'functions.php';
?>
<?php
		if(!isset($_SESSION["upassword"])){
	
		header("Location: loginForm.php?msg=Direct Access in Unauthorized");
	}
?>
<?php

$image_id=$_SESSION["uid"];
// The output message
$msg = '';
// Check if user has uploaded new image
if (isset($_FILES['image'])) {
	// The folder where the images will be stored
	$target_dir = 'images/';
	// The path of the new uploaded image
	$image_path = $target_dir . basename($_FILES['image']['name']);
	// Check to make sure the image is valid
	if (!empty($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name'])) {

			move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
	$sql="insert into profile_image (id,path,user_id) values('','$image_path','$image_id')";
	$result = mysqli_query($con,$sql);
	//$row = mysqli_fetch_assoc($result);
			$msg = 'Profile Image uploaded successfully!';
			header('Location:profile.php?msg=Profile Image uploaded successfully!');

	} else {
		$msg = 'Please upload an image!';
	}
}
?>
<?=template_header('Upload Image')?>

<div class="content upload">
	<h2>Upload Profile Image</h2>
	<form action="uploadProfile.php" method="post" enctype="multipart/form-data">
		<label for="image">Choose Image</label>
		<input type="file" name="image" accept="image/*" id="image">
	    <input type="submit" value="Upload Image" name="submit">
	</form>
	<p><?=$msg?></p>
</div>
<?=template_footer()?>
