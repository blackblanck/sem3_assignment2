<?php session_start(); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href= "includes/css/grid.css" rel="stylesheet">
<link href= "includes/css/styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">


<title>View images</title>

	

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

	<div class="col-1-1 imagedisplay">
	
<p class="main">Displaying all images:</p>

<?php 
	
require_once('db_con.php');	
	
$stmt = $link->prepare("SELECT idimages, url, title, users_idusers, username
from images, users
where users_idusers = idusers");
$stmt->execute();
$stmt->bind_result($imageid, $url, $title, $imageuid, $imageusername);
while($stmt->fetch()){
	
?>
		
	<h3>Added by <?=$imageusername?> (user id: <?=$imageuid?>) with title: '<?=$title?>'</h3>
	<img class="indimage" src="<?=$url?>"  />
	
<?php if ($_SESSION['uid'] == $imageuid ) { ?>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="idimages" value="<?=$imageid?>" />
			<button type="submit" name="cmd" value="delete_img">Delete</button>
		</form>
		<a href="rename_image.php?imageid=<?=$imageid?>">Rename</a>		
<?php }	?>
	

				
<?php } 

	
?>


	<?php
		if($cmd = filter_input(INPUT_POST, 'cmd')){

			if($cmd == 'delete_img'){
				// code to delete the category

				$imageid = filter_input(INPUT_POST, 'idimages')
					or die('Missing/illegal title parameter');

				require_once('db_con.php');
				$sql = 'DELETE FROM images WHERE idimages=(?)';
				$stmt = $link->prepare($sql);
				$stmt->bind_param('i', $imageid);
				$stmt->execute();

				if($stmt->affected_rows > 0){
					echo "<script type='text/javascript'>window.top.location='p1_loggedin.php';</script>";
				
				
				}
				
				else{
					echo 'Could not delete img '.$url;
				}			

			}
			else {
				die('Unknown cmd parameter');
			}
		}
?>



</div>

</body>
</html>