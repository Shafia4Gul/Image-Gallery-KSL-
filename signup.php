<?php
session_start();

include("includes/dbconfig.php");


if (isset($_POST['signupbtn'])) {

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];

if($name!="" && $email!="" && $password!="" && $dob!="" && $gender!="")
{
$sql1="Select * from user_info where email='$email'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_assoc($result1);
if($email==$row1["email"])
	{
	header('Location:loginForm.php?msg=Already registered.');
	exit();
	}
else
	{
	$sql="insert into user_info (name,email,password,dob,gender,id) values('$name','$email','$password','$dob','$gender','')";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	// if ($row) 
	//{
	$_SESSION["name"]=$row["name"];
	$_SESSION["email"]=$row["email"];
	$_SESSION["password"]=$row["password"];

	header('Location:loginForm.php?msg=Successfully registered.');
    exit();	
	}

}
}
?>
<!DOCTYPE html>
<?php
include 'functionsLoginForm.php';
?>
<html>
<head>
<?=template_header('SignUp')?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8);
};
function date() {
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear()-7;
 if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("max", today);
};
/*$(function(){
		var dtToday=new Date();
		
		var month=dtToday.getMonth()+1;
		var day=dtToday.gatDate();
		var year=dtToday.getFullYear();
		if(month<10)
			month='0'+month.toString();
		if(day<10)
			day='0'+day.toString();
		var maxDate=year+'-'+month+'-'+day;
		$("#dateControl").attr('min',maxDate);
});*/
</script>
</head>
<body>
<form action="signup.php" method="POST">
<div class="content home">
<table cellpadding="10px">

	<h2>REGISTRATION FORM</h2>

	<tr><td><label>Name</label></td>
		<td><input type="text" name="name" maxlength="20" autofocus
					title="Only Letters"
					placeholder="Type Letters Only"
					onkeydown="return alphaOnly(event);"
					onblur="if (this.value == '') {this.value = 'Type Letters Only';}"
					onfocus="if (this.value == 'Type Letters Only') {this.value = '';}"/></td></tr>
	<tr><td><label>Email</label></td>
		<td><input type="email" name="email" placeholder="********@gmail.com"autofocus required></td></tr>
	<tr><td><label>Password</label></td>
		<td><input type="password" name="password"autofocus required></td></tr>
	<tr><td><label>DOB</label></td>
		<td><input type="date"  id="datefield" name="dob" onfocus ="return date(event);" autofocus required></td></tr>

	<table>
	<tr>
	<td><label>Gender</label></td>
	<td>
	<input type="radio" name="gender" value="male">
	<label for="male">Male</label><br>
	<input type="radio" name="gender" value="female">
	<label for="female">Female</label><br>
	<td>
	<tr>
	</table>
	
	<input type="submit" value="signup" name="signupbtn"></input>
</table>	
</form>

</div>
</body>
</html>