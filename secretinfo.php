<?php session_start(); ?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link href="includes/css/grid.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Session</title>

<style>
	
	@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300);
	
	.info {
	margin-top: 5vh;
	padding-left: 18px;
	text-align:left;
	font-family: 'roboto condensed';
	font-size: 18px;
	font-weight:900;
	line-height: 150%;
	}
	

	</style>
</head>

<body>
<?php require('menu_loggedin.php'); ?>




  <div class="info col-1-2">
  	
  	<?php
	
	if (!empty($_SESSION['uid'])){
		echo 'Logged in as user '.$_SESSION['un'];
		echo ' You may now upload some images and see images uploaded by other users'; 
	 	
		
		
	}
	else {
		echo 'Not logged in...';
	}

?>

  
  
  
</div>
<div class="col-1-2"> 
 	
 	 	

</div>


</body>
</html>

<?php require('footer.php'); ?>
</body>
</html>