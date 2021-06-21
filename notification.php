<?php
	session_start();
	include 'fun.php';
$ui_id=$_SESSION["uid"];
// Connect to MySQL
$pdo = pdo_connect_mysql();
// MySQL query that selects all the images
//$stmt = $pdo->query('SELECT * FROM images where user_id=0 ORDER BY uploaded_date DESC');
//$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM postlike WHERE id=? ");
$stmt->execute([$ui_id]); 
	
		if(!isset($_SESSION["upassword"])){
	
		header("Location: loginForm.php?msg=Direct Access in Unauthorized");
	}
?>

<html>
<head>
	<link rel="stylesheet" href="news.css">
	 <?=template_header('Notification')?>
</head>
<body>
<div class="content home">
	<h2>NOTIFICATIONS</h2>

<?php
$con= mysqli_connect("localhost" , "root", "");
			mysqli_select_db($con,'likesystem');
$find_likes = mysqli_query($con , "SELECT * FROM postlike");
$i=0;
echo "</br>";
while($row = mysqli_fetch_assoc($find_likes))
{
	
	$likes_id = $row['id'];
	$likes = $row['likeonpost'];
	
	$i++;
}
    
	echo "<b> <i> <u>$i people like  post </u> </i></b>";
	echo "</br>";
	echo "</br>";

?>

<?php

$con= mysqli_connect("localhost" , "root", "");
			mysqli_select_db($con,'comments');
	 
$find_comments = mysqli_query($con , "SELECT * FROM comments");
$i=0;
while($row = mysqli_fetch_assoc($find_comments))
{
	
	$comments_name = $row['name'];
	$comments = $row['comment'];
	
	
	echo "new comment added to your post";
	echo "</br>";
	echo "$comments_name  comment <b> $comments  </b> on your  post <p> " ;
	$i++;
}
    
	echo "<b> <i> <u>  $i people commented on your   post </u> </i></b>";

?> 
</body>
</html>