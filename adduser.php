<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign-up</title>
<link href= "includes/css/grid.css" rel="stylesheet">
<link href= "includes/css/styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
<?php require('menu.php'); ?>


<div class="login">
<h2 class="login-header">Sign-up</h2>
<form class="login-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Add new user</legend>
    	<input name="un" type="text" placeholder="Username" required />
    	<input name="pw" type="password" placeholder="Password"  required/>
    	<input name="em" type="email" placeholder="E-mail"  required/>
    	<input type="submit" name="submit" value="Create user" />
    	
	</fieldset>
	<p class="message" style="text-align:center; color:red;"> Upon succesful completion of your registry, you will be directed to login page</p>
</form>
	
	<?php
	require_once('db_con.php');
	
	
	if(!empty(filter_input(INPUT_POST, 'submit'))) {
	$un = filter_input(INPUT_POST, 'un') or die('Username not accepted');
	$pw = filter_input(INPUT_POST, 'pw') or die('Password not accepted');
	$pw = password_hash($pw, PASSWORD_DEFAULT);  // hash and salt the password
	$em = filter_input(INPUT_POST, 'em', FILTER_VALIDATE_EMAIL) or die('a legit address please');
	
//echo 'Created user: '.$un.' with e-mail address: ' .$em;
	
	$sql = 'INSERT INTO users (username, pwhash, email) VALUES (?,?,?)';
	$stmt = $link->prepare($sql);  //storing in stmt
	$stmt->bind_param('sss', $un, $pw, $em);
	$stmt->execute();

	if($stmt->affected_rows >0){
		
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
		echo ' user ['.$un.'] is added. Welcome '.$un.', normally I would expect you to receive a confirmation mail to login however this one is on me :), please proceed with login';
		
	}
	else {
		echo 'Error adding user ['.$un.'] this user already exists';
	}


		
}
?>

	</div>




<?php require('footer.php'); ?>

</body>
</html>