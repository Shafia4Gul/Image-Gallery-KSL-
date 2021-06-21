<?php
session_start();
    if(!isset($_SESSION["upassword"])){
    	header("Location:loginForm.php?msg=Direct Access is Unauthorized!!");
    }
include 'functions.php';
$ui_id=$_SESSION["uid"];
// Connect to MySQL
$pdo = pdo_connect_mysql();
// MySQL query that selects all the images
//$stmt = $pdo->query('SELECT * FROM images ORDER BY uploaded_date DESC');
//$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare('SELECT * FROM images WHERE user_id=? ORDER BY uploaded_date DESC');
$stmt->execute([$ui_id]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Gallery')?>

<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
     
<div class="content home">

	<h2>Gallery</h2>
	
	<!--------live  search------>
	<div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
          <input type="text" id="search_data" placeholder="Enter Title..." autocomplete="off" class="form-control input-lg" />
        </div>
        <div class="col-md-3">

        </div>
      </div>
<br/>
	
	<a href="upload.php" class="upload-image">Upload Image</a>
	<div class="images">
		<?php foreach ($images as $image): ?>
		<?php if (file_exists($image['path'])): ?>
		<a href="#">
			<img src="<?=$image['path']?>" alt="<?=$image['description']?>" data-id="<?=$image['id']?>" data-title="<?=$image['title']?>" width="100%" height="100%">
			<span><?=$image['title']?></span>
		</a>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="image-popup"></div>
<script type="text/javascript">
// Container we'll use to show an image
let image_popup = document.querySelector('.image-popup');
// Loop each image so we can add the on click event
document.querySelectorAll('.images a').forEach(img_link => {
	img_link.onclick = e => {
		e.preventDefault();
		let img_meta = img_link.querySelector('img');
		let img = new Image();
		img.onload = () => {
			// Create the pop out image
			image_popup.innerHTML = `
				<div class="con">
					<h3>${img_meta.dataset.title}</h3>
					<p>${img_meta.alt}</p>
					<img src="${img.src}" width="400px" height="300px">
					<a href="delete.php?id=${img_meta.dataset.id}" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i></a>
						<form action="like_post.php" method="POST">
					<input type="submit" value= "like" > </form>
						   <form action="post_comment.php" method="POST">
                    <textarea name="comment" cols="25" rows="2"  required>  </textarea> 
               <input type="submit" value= "comment" >	</form>	
				
				</div>
			`;
			image_popup.style.display = 'flex';
		};
		img.src = img_meta.src;
	};
});
// Hide the image popup container if user clicks outside the image
image_popup.onclick = e => {
	if (e.target.className == 'image-popup') {
		image_popup.style.display = "none";
	}
};
</script>

<?=template_footer()?>
  </body>
</html>
<script>
  $(document).ready(function(){
      
    $('#search_data').autocomplete({
      source: "ajaxlivesearch.php",
      minLength: 1,
      select: function(event, ui)
      {
        $('#search_data').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
      return $("<li class='ui-autocomplete-row'></li>"

      	)
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);

// Loop each image so we can add the on click event
document.querySelectorAll('item').forEach(img_link => {
	img_link.onclick = e => {
		e.preventDefault();
		let img_meta = img_link.querySelector('img');
		let img = new Image();
		img.onload = () => {
			// Create the pop out image
			image_popup.innerHTML = `
				<div class="con">
					<h3>${img_meta.dataset.title}</h3>
					<p>${img_meta.alt}</p>
					<img src="${img.src}" width="400px" height="300px">
					<a href="delete.php?id=${img_meta.dataset.id}" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i></a>
						<form action="like_post.php" method="POST">
					<input type="submit" value= "like" > </form>
						   <form action="post_comment.php" method="POST">
                    <textarea name="comment" cols="25" rows="2"  required>  </textarea> 
               <input type="submit" value= "comment" >	</form>	
				
				</div>
			`;
			image_popup.style.display = 'flex';
		};
		img.src = img_meta.src;
	};
});
// Hide the image popup container if user clicks outside the image
image_popup.onclick = e => {
	if (e.target.className == 'image-popup') {
		image_popup.style.display = "none";
	}
};
    };

  });
</script>