<?php
include 'config/connection.php';
$id=$_GET['id'];
$selectQuery="select * from products where id='$id'";
$query=mysqli_query($con,$selectQuery);
$result=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit_products</title>
  <link rel="stylesheet" href="css/editproduct.css">
</head>
<body>
 <h1>Update Products</h1> 
 <form action="" method="POST" enctype="multipart/form-data">
<input type="number" name="pro_id"  value="<?php echo $result['product_id']?>">
<img src="<?php echo $result['product_image']?>" alt="">
<input type="file" name="pro_image" id="">
<input type="text" name="title" value="<?php echo $result['product_title']?>">
<input type="text" name="price" value="<?php echo $result['price']?>">
<input type="submit" value="Update " name="submit">
 </form>
 <a href="display_products.php">Check Now</a>
</body>
</html>
<?php
if(isset($_POST['submit'])){
  $Pro_id=$_POST['pro_id'];
  $pro_title=$_POST['title'];
  $price=$_POST['price'];
  $pro_image=$_FILES['pro_image'];
  $image_name=$pro_image['name'];
  $image_Path=$pro_image['tmp_name'];
  $image_error=$pro_image['error'];
  if($image_error==0){
    $destfile='upload_image/'.$image_name;
    move_uploaded_file($image_Path,$destfile);
    $updateQuery="update products set product_id='$Pro_id',product_image='$destfile',product_title='$pro_title',price='$price' where id='$id'";
    $query=mysqli_query($con,$updateQuery);
    if($query){
      echo " Updated Successfully";
    }
    else{
      echo "Updation Failed";
    }
  }
}
?>