<?php
	session_start();
	include 'functions.php';
	
		if(!isset($_SESSION["upassword"])){
	
		header("Location: loginForm.php?msg=Direct Access in Unauthorized");
	}
?>
<html>
 <head>
 <title>Search Account</title>
	<?=template_header('Gallery')?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Webslesson Tutorial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <body>
 <div class="content home">
	<h2>SEARCH ANOTHER ACCOUNT</h2>

  <div class="container">
   <br />
<!--------live  search------>
  <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
          <input type="text" id="search_text" name="search_text" placeholder="Search by Name or Email." autocomplete="off" class="form-control input-lg" />
        </div>
        <div class="col-md-3">

        </div>
      </div>
   <br />
   <br />
   <div id="result"></div>
  </div>
  <div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch1.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>