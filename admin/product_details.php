<?php
include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product_details</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="text" name="product_id" placeholder="Enter the Product ID">
  <input type="text" name="title" placeholder="Enter the product title">
  
  <textarea name="description" placeholder="Description of the product" rows="4" cols="50"></textarea>
  
  <input type="text" name="final_price" placeholder="Final price of the Product">
  <input type="text" name="expected_price" placeholder="Expected price of the product">
  <input type="number" name="quantity" placeholder="Product Quantity">

  <label for="image">Main Image</label>
  <input type="file" name="main_image" id="image">
  
  <div class="image_container">
    <h4>Gallery Images</h4>
    <div class="image_items">
      <input type="file" name="image1">
      <input type="file" name="image2">
      <input type="file" name="image3">
      <input type="file" name="image4">
    </div>
  </div>

  <textarea name="care_instruction" placeholder="Care Instructions for Products" rows="4" cols="50"></textarea>

  <textarea name="disclaimer" placeholder="Disclaimer of the product" rows="4" cols="50"></textarea>

  <input type="submit" value="ADD" name="submit">
</form>

<a href="Display_products_detail.php">Check Now</a>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
  $product_id = $_POST['product_id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $final_price = $_POST['final_price'];
  $expected_price = $_POST['expected_price'];
  $quantity = $_POST['quantity'];
  $care_instruction = $_POST['care_instruction'];
  $disclaimer = $_POST['disclaimer'];

  // Main image
  $main_image = $_FILES['main_image'];
  $mainimagename = $main_image['name'];
  $mainimagepath = $main_image['tmp_name'];
  $mainimageerror = $main_image['error'];

  // Gallery images
  $image1name = $_FILES['image1']['name'];
  $image1path = $_FILES['image1']['tmp_name'];
  $image1error = $_FILES['image1']['error'];

  $image2name = $_FILES['image2']['name'];
  $image2path = $_FILES['image2']['tmp_name'];
  $image2error = $_FILES['image2']['error'];

  $image3name = $_FILES['image3']['name'];
  $image3path = $_FILES['image3']['tmp_name'];
  $image3error = $_FILES['image3']['error'];

  $image4name = $_FILES['image4']['name'];
  $image4path = $_FILES['image4']['tmp_name'];
  $image4error = $_FILES['image4']['error'];

  if($mainimageerror == 0 && $image1error == 0 && $image2error == 0 && $image3error == 0 && $image4error == 0) {
    $destfile1 = 'upload_image/' . $mainimagename;
    move_uploaded_file($mainimagepath, $destfile1);

    $destfile2 = 'upload_image/' . $image1name;
    move_uploaded_file($image1path, $destfile2);

    $destfile3 = 'upload_image/' . $image2name;
    move_uploaded_file($image2path, $destfile3);

    $destfile4 = 'upload_image/' . $image3name;
    move_uploaded_file($image3path, $destfile4);

    $destfile5 = 'upload_image/' . $image4name;
    move_uploaded_file($image4path, $destfile5);

    $insertquery = "INSERT INTO products_details 
    (product_id, title, description, final_price, expected_price, quantity, main_image, image1, image2, image3, image4, care_instruction, disclaimer) 
    VALUES 
    ('$product_id', '$title', '$description', '$final_price', '$expected_price', $quantity, '$destfile1', '$destfile2', '$destfile3', '$destfile4', '$destfile5', '$care_instruction', '$disclaimer')";

    $query = mysqli_query($con, $insertquery);

    if($query)
      echo "Insertion successful";
    else
      echo "Insertion failed";
  } else {
    echo "One or more images failed to upload.";
  }
}
?>
