<?php require 'dbconn.php'; 
$sql = "SELECT * FROM news";
$posts = $db->query($sql);

// Start session to check if they are logged in
session_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>News</title>
</head>

<body>
<?php
// if Session variable "email" is found the user is logged in
// and can see the logout link
if ($_SESSION){
if (@!$_SESSION['email']){
	echo "<a href='login.php' title='Login'>Login</a>";
} else {
	echo "<a href='logout.php' title='Logout'>Logout</a>";
}
}
if (!$_SESSION){
	echo "<a href='login.php' title='Login'>Login</a>";
}
	?>
<table>
	<tr>
    	<th>Post</th><th>Date</th>
    </tr>
    <?php foreach($posts as $post) : ?>
	<tr>
    	<td><?php echo $post['post']; ?></td>
        <td><?php echo $post['date']; ?></td>
        <?php 
		// if Session variable "email" is found the user is logged in
		// and can see the delete link
		if ($_SESSION){
		if (@!$_SESSION['email']){
		} else {
			echo "<td><a href='deleteNews.php?delete=maybe&id=".$post['id']."'  title='DELETE'>Delete</a></td>";
		}
		}
		?>
    </tr>
    <?php endforeach; ?>
</table>
<p>Add a News post: <a href="insertNews.php" title="Add">Add</a></p>
</body>
</html>