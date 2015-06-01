<?php
include 'errors.php';
$message = " ";
$valid = false;
// Check to see if form was submitted via POST
if($_POST){
// Check for fname
if($_POST['fname']){
$fname = $_POST['fname'];
$valid = true;
} else {
	$valid = false;
	$message .= "First Name is required.<br />";
} // end fname check
// Check for lname
if($_POST['lname']){
$lname = $_POST['lname'];
$valid = true;	
} else {
	$valid = false;
	$message .= "Last Name is required.<br />";
}// end lname check
// check for email
if($_POST['email']){
$email = $_POST['email'];
$valid = true;	
// split the email address in to 2 array elements called $domain[]
$domain = explode("@", $email);
	// check the second piece of the $domain[1] array for the
	// domain to see if that web server has mail exchange records
	if(getmxrr($domain[1], $mxhosts) == FALSE){
		$message .= "That Email Address is not valid.<br />";
		$valid = false; 
	} else {
    	// The Email Address exists
    	// try to query the DB
		try{
		// bring in the DB connection
		require 'dbconn.php';
		// Check to see if that Email Address exists in our DB
			$sql = "SELECT * FROM users WHERE email = '$email'";
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
		$message .= "There was an error checking the DB for the Email Address: " . $e->getMessage();	
		} // end try catch
 // Email Address exists in the DB
		if ($count != 0){
			$valid = false;
			$message = "That Email Address already exists in our database.";
		}
		} // end getmxrr
	} else {
		$valid = false;
		$message .= "Email Address is required.<br />";
	} //end email check
// check password
if($_POST['pass']){
$valid = true;
$pass = $_POST['pass'];
} else {
$valid = false;
$message .= "Please enter a password.<br />";
} // pass check
// check confirm password
if ($_POST['pass2']){
$valid = true;
$pass2 = $_POST['pass2'];
	// Check to see that the passwords match
	  if ($pass != $pass2){
		  $valid = false;
		$message .= "The passwords do not match.";  
	  } else {
		  $valid = true;
		  // Encrypt Password
		$encPass = md5($pass); 
	  } // end password match
} else {
	$valid = false;
	$message .= "Please confirm your password.<br />";
} // end pass2 check
if($valid && $count == 0){
	//echo $email, $encPass, $fname, $lname;
	// try to query the DB
		try{
		// Check to see if that Email Address exists in our DB
			$sql = "INSERT INTO users (id, email, password, fname, lname) VALUES ('', '$email', '$encPass', '$fname', '$lname')";
		// execute SQL query
		$row = $db->prepare($sql);
		$row->execute();
		// let user know that the info was inserted into the DB
		$message .= "Account registered.<br />";
		} 
		// catch the Exception if it could not query the DB
		catch (Exception $e){
		// Display an error message as well as the system generated error
		$message .= "There was an error registering account: " . $e->getMessage();	
		} // end try catch
} // end $valid check

}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
</head>

<body>
<p><?php echo $message; ?></p>
<form method="post">
<table>
    <tr>
    	<td>First Name:</td><td><input type="text" name="fname" required /></td>
    </tr>
    <tr>
   	 	<td>Last Name:</td><td><input type="text" name="lname" required /></td>
    </tr>
    <tr>
    	<td>Email Address:</td><td><input type="email" name="email" placeholder="email@website.com" required /></td>
    </tr>
    <tr>
    	<td>Password:</td><td><input type="password" name="pass" required /></td>
    </tr>
    <tr>
    	<td>Password:</td><td><input type="password" name="pass2" required /></td>
    </tr>
    <tr>
    	<td>&nbsp;</td><td><input type="submit" name="submit" value="Submit" /></td>
    </tr>
</table>
</form>
</body>
</html>