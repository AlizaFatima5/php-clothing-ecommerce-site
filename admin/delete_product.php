<?php
include 'config/connection.php';
$id=$_GET['id'];
$deleteQuery="delete from products where id='$id'";
$query=mysqli_query($con,$deleteQuery);
if($query){
  header("location:display_products.php");
}
?>
