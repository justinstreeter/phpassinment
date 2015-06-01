<?php
session_start();
if($_SESSION) {
unset($_SESSION['email']);
echo "You are now logged out";
echo "<a href='index.php' title='Home'>News Blog Home</a>";
}

?>