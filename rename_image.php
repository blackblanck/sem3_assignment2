<?php session_start(); ?>


<?php require('menu_loggedin.php'); ?>
<?php
	
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'rename_image'){
		
		$imageid = filter_input(INPUT_POST, 'idimages', FILTER_VALIDATE_INT)
			or die('Missing/illegal image id parameter');
		$title = filter_input(INPUT_POST, 'title')
			or die('Missing/illegal title parameter');
		
		require_once('db_con.php');
		$sql = 'UPDATE images SET title=? WHERE idimages=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('si', $title, $imageid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Title changed!!!';
		}
		else{
			echo 'Nothing was changed ?!?!?!';
		}
		
	}
	else {
		die('Unknown cmd parameter');
	}
}
?>


	<h3>Rename image</h3>

<?php
	
	if(empty($imageid)){
		$imageid = filter_input(INPUT_GET, 'imageid', FILTER_VALIDATE_INT)
			or die('Missing/illegal image laylaylom parameter');
	}
	
	require_once('db_con.php');
	$sql = 'SELECT title FROM images WHERE idimages=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('i', $imageid);
	$stmt->execute();
	$stmt->bind_result($title);
	while($stmt->fetch()) {}
	
	?>
	
<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Rename category</legend>
    	<input name="idimages" type="hidden" value="<?=$imageid?>" />
    	<input name="title" type="text" value="<?=$title?>" placeholder="Title" required />
		<button name="cmd" value="rename_image" type="submit">Rename your image</button>
  	</fieldset>
</form>
</p>
<a href="p1_loggedin.php"> See your image with its new title </a>
</body>
</html>