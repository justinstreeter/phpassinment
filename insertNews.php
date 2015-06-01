<?php
// set $message variable to " "
$message = " ";
// set timezone to EST
date_default_timezone_set('US/Eastern');
// set date variable to mm/dd/yyyy
$date = date('m/d/Y h:m:s');
// Check to see that the form was posted before checking variables
if($_POST){
// check to see if anything was posted
if(empty($_POST['post'])){
	// warn the user they did not post anything
	$message = "You did not post anything";
} else {
	// if the user poseted something short-form the variable
	$post = $_POST['post'];
	// set $message variable to " "
	$message = " ";
	// try to query the DB
	try{
	// bring in the DB connection
	require 'dbconn.php';
	// SQL query in the $sql variable
	$sql = "INSERT INTO news (id, post, date) VALUES ('', '$post', '$date')";
	// execute SQL query
	$db->query($sql);
	// Redirect to the homepage to see entries
	header( 'Location: index.php');
	} 
	// catch the Exception if it could not query the DB
	catch (Exception $e){
	// Display an error message as well as the system generated error
	echo "There was an error adding news: " . $e->getMessage();	
	}
}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert News</title>
</head>

<body>
<p><?php echo $message; ?></p>
<form method="post">
<table>
    <tr>
    	<td>Date:</td><td><input type="text" name="date" value="<?php echo $date; ?>" readonly/></td>
    </tr>
    <tr>
    	<td>Post:</td><td><textarea rows="10" name="post" placeholder="Add News"></textarea></td>
    </tr>
    <tr>
    	<td>&nbsp;</td><td><input type="submit" name="submit" value="Submit" /></td>
    </tr>
    
</table>
</form>
</body>
</html>