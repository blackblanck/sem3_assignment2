<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href= "includes/css/grid.css" rel="stylesheet">
<link href= "includes/css/styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

<?php require('menu.php'); ?>



<div class="login">
<h2 class="login-header">Log in</h2>
<form class="login-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Login</legend>
    	<input name="un" type="text" placeholder="Username" required />
    	<input name="pw" type="password" placeholder="Password"  required/>
    	<input type="submit" name="submit" value="Login" />
	</fieldset>
	
	<p class="message">Not registered yet? <a href="adduser.php">Create an account</a></p>
</form>
<?php
require_once('db_con.php');
	
if(!empty(filter_input(INPUT_POST, 'submit'))) {

	
	
	$un = filter_input(INPUT_POST, 'un') or die('incorrect useername');
	$pw = filter_input(INPUT_POST, 'pw') or die('incorrect password');
	//$password = password_hash($password, PASSWORD_DEFAULT); // hash and salt the password 
	
	
	$sql = 'SELECT idusers, username, pwhash FROM users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $uname,  $pwhash);

	while ($stmt->fetch()) {} // fill result variables
	
	if (password_verify($pw, $pwhash)){
		
		echo 'You are now logged in as user '.$uname.' id:'.$uid;
		$_SESSION['uid'] = $uid; 
		$_SESSION['un'] = $uname;
		
		
		echo "<script type='text/javascript'>window.top.location='secretinfo.php';</script>";
	}
	else {
		echo 'something went wrong, please make sure you enter correct username and password';
	}
}
?>
</div>

<?php require('footer.php'); ?>



</body>
</html>