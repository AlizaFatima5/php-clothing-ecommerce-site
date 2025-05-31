<?php
include 'config/connection.php';
$id=$_GET['id'];
$deleteQuery="delete from banners where id='$id'";
$query=mysqli_query($con,$deleteQuery);
if($query)
header("location:banner_display.php")
?>