<?php
include 'config/connection.php';

$id = $_GET['id'];
$query = "SELECT * FROM products_details WHERE id = $id";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="text" name="title" value="<?= $data['title'] ?>" placeholder="Enter the product title">
  
  <textarea name="description" rows="4" cols="50"><?= $data['description'] ?></textarea>
  
  <input type="text" name="final_price" value="<?= $data['final_price'] ?>" placeholder="Final price of the Product">
  <input type="text" name="expected_price" value="<?= $data['expected_price'] ?>" placeholder="Expected price of the product">
  <input type="number" name="quantity" value="<?= $data['quantity'] ?>" placeholder="Product Quantity">

  <label for="image">Main Image</label><br>
  <img src="<?= $data['main_image'] ?>" width="100"><br>
  <input type="file" name="main_image" id="image">
  
  <h4>Gallery Images</h4>
  <div>
    <img src="<?= $data['image1'] ?>" width="100"><br>
    <input type="file" name="image1"><br>

    <img src="<?= $data['image2'] ?>" width="100"><br>
    <input type="file" name="image2"><br>

    <img src="<?= $data['image3'] ?>" width="100"><br>
    <input type="file" name="image3"><br>

    <img src="<?= $data['image4'] ?>" width="100"><br>
    <input type="file" name="image4"><br>
  </div>

  <textarea name="care_instruction" rows="4" cols="50"><?= $data['care_instruction'] ?></textarea>

  <textarea name="disclaimer" rows="4" cols="50"><?= $data['disclaimer'] ?></textarea>

  <input type="submit" value="UPDATE" name="update">
</form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $final_price = $_POST['final_price'];
  $expected_price = $_POST['expected_price'];
  $quantity = $_POST['quantity'];
  $care_instruction = $_POST['care_instruction'];
  $disclaimer = $_POST['disclaimer'];

  // Check if a new image is uploaded, otherwise keep old one
  function uploadOrKeep($fieldName, $oldPath) {
    if ($_FILES[$fieldName]['error'] == 0) {
      $filename = $_FILES[$fieldName]['name'];
      $filepath = $_FILES[$fieldName]['tmp_name'];
      $dest = 'upload_image/' . $filename;
      move_uploaded_file($filepath, $dest);
      return $dest;
    }
    return $oldPath;
  }

  $main_image = uploadOrKeep('main_image', $data['main_image']);
  $image1 = uploadOrKeep('image1', $data['image1']);
  $image2 = uploadOrKeep('image2', $data['image2']);
  $image3 = uploadOrKeep('image3', $data['image3']);
  $image4 = uploadOrKeep('image4', $data['image4']);

  $updatequery = "UPDATE products_details SET 
    title='$title',
    description='$description',
    final_price='$final_price',
    expected_price='$expected_price',
    quantity=$quantity,
    main_image='$main_image',
    image1='$image1',
    image2='$image2',
    image3='$image3',
    image4='$image4',
    care_instruction='$care_instruction',
    disclaimer='$disclaimer'
    WHERE id=$id";

  $result = mysqli_query($con, $updatequery);
  
  if ($result) {
    echo "Update successful";
  } else {
    echo "Update failed: " . mysqli_error($con);
  }
}
?>
