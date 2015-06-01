<?php
$dsn = 'mysql:host=localhost;dbname=content';
$user = 'root';
$pass = '';

try{
	$db = new PDO($dsn, $user, $pass);
} catch (PDOException $e){
	$error_message = $e->getMessage();
	echo "<p>An error has occurred while connecting to the DB: $error_message </p>";
}
?>