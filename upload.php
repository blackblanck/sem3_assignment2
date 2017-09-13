<?php session_start(); ?>

<?php require('menu_loggedin.php'); ?>


<?php
require_once('db_con.php');

	
echo 'logged in as id:'.$_SESSION['uid'];
	
$title = filter_input(INPUT_POST, 'title') or die('title not accepted');

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// If you need unique names:
//$target_file = $target_dir . uniqid().'.'.$imageFileType;	
	
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		
		require_once('db_con.php');
		
		$sql = 'INSERT INTO images (url, title, users_idusers) VALUES (?,?,?)';
		
			$stmt = $link->prepare($sql);
		$stmt->bind_param('ssi', $target_file, $title, $_SESSION['uid']);
		$stmt->execute();
		echo '<br>affected rows:'.$stmt->affected_rows.'<br>';
		if ($stmt->affected_rows > 0) {
			echo 'Filedata added to the database :)';
		}
		else {
			echo 'Could not add the file to the database :(';
		}
		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<br><br>
	<a href="index_loggedin.php">Go back</a><br>
	<a href="p1_loggedin.php"> Go see those images </a>
	
	<?php require('footer.php'); ?>
