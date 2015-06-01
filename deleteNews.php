<?php
// short-form the GET variable "id"
$id = $_GET['id'];
// short-form the GET variable "delete"
$delete = $_GET['delete'];
// confirm that the user would like to delete the post
echo "Are you sure you would like to delete that news post?";
// Display a Delete link
echo "<a href='deleteNews.php?delete=yes&id=".$id."' title='Yes'>Yes</a> ";
// Display a No link that re-direct to the home page (index.php)
echo "<a href='index.php' title='No'>no</a> ";
 // If the confirmed by clicking the "Yes" link
if($delete == 'yes'){
// include the db connection script
require 'dbconn.php';
// SQL query to Delete from the DB
$sql = "DELETE FROM news WHERE id = '$id'";
// Run Query
$db->query($sql);
// Alert the user using JavaScript to let them know the post was deleted
// redirect to the home page (index.php)
echo "<script>alert('Post Deleted!');location.href='index.php';</script>";
}
?>