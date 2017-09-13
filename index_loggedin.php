<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href= "includes/css/grid.css" rel="stylesheet">
<link href= "includes/css/styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">


<title>Home</title>

</head>

<body>
<?php require('menu_loggedin.php'); ?>


  <div class="info">
  	
  	<?php
	
	if (!empty($_SESSION['uid'])){
		echo 'Logged in as '.$_SESSION['un'];
		
	}
	else {
		echo 'Not logged in...';
	}

?>

	</div>

<div class="main">Select image to upload:
	<form action="upload.php" method="post" enctype="multipart/form-data">
     	<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    	<input type="text" name="title" placeholder="Image title" required /><br><br>
    	<input type="submit" value="upload" name="upload">
	</form>
	
	<p> Lets <a href="p1_loggedin.php">view those pictures</a></p>

<p> or lets <a href="secretinfo.php">Go to profile</a></p>
</div>
<?php require('footer.php'); ?>
</body>
</html>