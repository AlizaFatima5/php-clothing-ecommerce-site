<?php
include 'config/connection.php';
$id=$_GET['id'];
$selectQuery="select * from category where id='$id'";
$query=mysqli_query($con,$selectQuery);
$result=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit_category</title>
  <link rel="stylesheet" href="css/editcategory.css">
</head>
<body>
  <h1>Edit Your Category</h1>
  <form action="" method="POST" enctype="multipart/form-data">
  <img src="<?php echo $result['cat_image']?>" alt="">
  <input type="file" name="image" id="">
  <input type="text" name="heading" value="<?php echo $result['cat_heading']?>">
  <input type="submit" name="submit" value="Update">

  </form>
  <a href="display_category.php">Check Now</a>
</body>
</html>
<?php
if(isset($_POST['submit'])){
  $heading=$_POST['heading'];
  $image=$_FILES['image'];
  $img_name=$image['name'];
  $img_path=$image['tmp_name'];
  $img_error=$image['error'];
  if($img_error==0){
    $dest_file='upload_image/'.$img_name;
    move_uploaded_file($img_path,$dest_file);
    
    $updateQuery="update category set cat_image='$dest_file',cat_heading='$heading' where id='$id'";
    $query=mysqli_query($con,$updateQuery);
    if($query){
      echo " Updated Successfully";
    }
  }
}

?>