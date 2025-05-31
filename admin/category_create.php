<?php
include 'config/connection.php';

if(isset($_POST['submit'])){
  $Heading = $_POST['heading'];
  $Image = $_FILES['image'];
  $img_name = $Image['name'];
  $img_Path = $Image['tmp_name'];
  $img_Error = $Image['error'];

  if($img_Error == 0){
    $dest_file = 'upload_image/'.$img_name;
    move_uploaded_file($img_Path, $dest_file);

    $insertQuery = "INSERT INTO category (cat_image, cat_heading) VALUES ('$dest_file', '$Heading')";
    $query = mysqli_query($con, $insertQuery);

    if($query){
      echo "<p class='success-msg'>Insertion successful</p>";
    } else {
      echo "<p class='error-msg'>Insertion failed</p>";
    }
  } else {
    echo "<p class='error-msg'>Image contains an error</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADD_Category</title>
  <link rel="stylesheet" href="css/categorycreate.css">
</head>
<body>

  <h1>ADD Category</h1>
  
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="image-upload" onchange="displayImage(this)">
    <input type="text" name="heading" placeholder="Enter Heading for category">
    <img id="image-preview" alt="Image Preview">
    <input type="submit" name="submit" value="ADD">
  </form>
  
  <a href="display_category.php">Check now</a>

  <script>
    // This function will display the selected image as a preview
    function displayImage(input) {
      const file = input.files[0];
      const reader = new FileReader();
      
      reader.onload = function(e) {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = e.target.result; // Set the image source to the selected file
        imagePreview.style.display = 'block'; // Show the image preview
      }
      
      if (file) {
        reader.readAsDataURL(file); // Read the file as a Data URL
      }
    }
  </script>

</body>
</html>
