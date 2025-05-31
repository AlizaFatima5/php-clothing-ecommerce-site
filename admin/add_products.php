<?php
include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add_Products</title>
  <link rel="stylesheet" href="css/addproducts.css">
</head>
<body>
  <h1>ADD Products</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="number" name="pro_id" id="" placeholder="Product ID">
    <input type="file" name="image" id="imageInput" onchange="previewImage(event)">
<img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-width: 300px; margin-top: 20px;">

    <input type="text" name="title" id="" placeholder="title">
    <input type="text" name="price" placeholder="Product price">
<input type="submit" value="ADD Products" name="submit">
<a href="product_details.php">Add product details</a>
  </form>
  <a href="display_products.php">Check Now</a>
</body>
<script>
  function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = "block";
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

</html>
<?php
if(isset($_POST['submit'])){
  $Product_id=$_POST['pro_id'];
  $Pro_title=$_POST['title'];
  $Pro_Price=$_POST['price'];
  $Pro_image=$_FILES['image'];
  $image_name=$Pro_image['name'];
  $image_Path=$Pro_image['tmp_name'];
  $image_error=$Pro_image['error'];
  if($image_error==0){
    $dest_file='upload_image/'.$image_name;
    move_uploaded_file($image_Path,$dest_file);
    $insertQuery="insert into products(product_id,product_image,product_title,price) values('$Product_id','$dest_file','$Pro_title','$Pro_Price')";
    $query=mysqli_query($con,$insertQuery);
    if($query){
      echo " Insertion Successful";
    }
    else{
      echo "Insertion Failed";
    }
  }

}
?>