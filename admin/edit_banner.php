<?php
include 'config/connection.php';
$ID=$_GET['id'];
$selectQuery="select * from banners where id='$ID'";
$query=mysqli_query($con,$selectQuery);
$result=mysqli_fetch_assoc($query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/editbanner.css">
  <title>Edit_Banner</title>
</head>
<body>
  <h1>Update Youe banners</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    
    <input type="number" name="ban_id" value="<?php echo $result['ban_id']?>">
    <img src="<?php echo $result['ban_image']?>" alt="">
    <input type="file" name="img"  alt="">
    
    <input type="submit" name="submit" value="Update">
  </form>
  <a href="banner_display.php">Check Now</a>
</body>
</html>
<?php
if(isset($_POST['submit'])){

  $ban_id=$_POST['ban_id'];
  $image=$_FILES['img'];

  $img_name=$image['name'];
  $img_path=$image['tmp_name'];
  $img_error=$image['error'];
  if($img_error==0){
    // echo " Hello Aliza";
  
    $destfile='upload_image/'.$img_name;
    move_uploaded_file($img_path,$destfile);
  $updateQuery="update banners set ban_id='$ban_id',ban_image='$destfile' where id='$ID'";
  $query=mysqli_query($con,$updateQuery);
  if($query){
    echo " updated Successfully";
  }
  else
  {
    echo " update failed";
  }
}
else{
  echo " GoodBYE ALiza";
}
}
?>