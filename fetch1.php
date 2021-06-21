<?php
$connect = mysqli_connect("localhost", "root", "", "bsse");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM user_info 
  WHERE name LIKE '%".$search."%'
  OR email LIKE '%".$search."%' 
  OR gender LIKE '%".$search."%'
  OR dob LIKE '%".$search."%' 
 ";
}
else
{
 $query = "SELECT * FROM user_info";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Name</th>
     <th>Email</th>
     <th>DOB</th>
     <th>Gender</th>

    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["name"].'</td>
    <td>'.$row["email"].'</td>
    <td>'.$row["dob"].'</td>
    <td>'.$row["gender"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>