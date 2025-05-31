<?php
$username="root";
$password="";
$server="localhost";
$db="AliBaba";
$con=mysqli_connect($server,$username,$password,$db);
if(!$con){
  echo " Connection failed";
}
// else {
//   echo "connection successful";
// }

?>