<?php
	session_start();
	include 'functionsSearch.php';
		if(!isset($_SESSION["upassword"])){
	
		header("Location: loginForm.php?msg=Direct Access in Unauthorized");
	}
?>

	<html>
<head>
<?=template_header('Search')?>
<style>
ul{
	list-style-type: none;
	padding: 30px 0;
	width: 200px;
	height: 100%;
}
ul li{
	padding: 15px;
	border-bottom: 1px solid rgba(0,0,0,0.05);
	border-top: 1px solid rgba(225,225,225,0.05);
	
}
</style>
</head>
<body>
<div class="content home">
<h2>Search By Email</h2>
	<form action="searchHandler.php" method="POST">
	<ul>
	<li><label>Search by Gender</label>
	<input type="text"  name="Sgender" autofocus><br></li>
	<li><input type="submit" value="search"></input></li>
	</ul>
	</form>
</body>	
	</html>