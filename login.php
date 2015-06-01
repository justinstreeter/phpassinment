<?php
$message = " ";
$valid = false;
if($_POST){
	if(isset($_POST['email'])){
	$email = $_POST['email'];	
	$valid = true;
	} else {
	$valid = false;
	$message = "You did not submit your Email Address.";
	}
	if(isset($_POST['password'])){
	$pass = $_POST['password'];
	$valid = true;
	} else {
	$valid = false;
	$message = "You did not submit your Password.";
	}
	if($valid){
		// try to query the DB
		try{
		// bring in the DB connection
		require 'dbconn.php';
		// encrypt password for validation
		$md5pass=md5($pass);
		// Check to see if that Email Address exists in our DB
			$sql = "SELECT email, password FROM users WHERE email = '$email' AND password = '$md5pass';";
		// execute SQL query
		$row = $db->prepare($sql);
		$row->execute();
		// Count results, if found $count == 1
		$count = $row->rowCount();
		// echo $count;
		} 
		// catch the Exception if it could not query the DB
		catch (Exception $e){
		// Display an error message as well as the system generated error
		$message .= "There was an error checking the login info: " . $e->getMessage();	
		} // end try catch
         // User Authenticated in the DB
		if ($count != 0){
			echo "You are logged in.";
		} else {
			echo "Please register";
		}
		
	} // end valid
} // end POST check

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
<p><?php echo $message; ?></p>
<h3>Login</h3>
<form name="login" method="post">
<p>Enter your email address:
<input type="email" name="email" placeholder="name@website.com" required /></p>
<p>Enter your password:
<input type="password" name="password" required /></p>
<input type="reset" name="reset" value="Reset" />
<input type="submit" name="login" value="Log In" onClick="login.submit();" />
</form>
</body>
</html>