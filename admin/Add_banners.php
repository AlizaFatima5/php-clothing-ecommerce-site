<?php 
include 'config/connection.php';
$successMessage = '';
if (isset($_POST['submit'])) {
    $ID = $_POST['Ban_id'];
    $Image = $_FILES['ban_img'];
    $img_name = $Image['name'];
    $img_Path = $Image['tmp_name'];
    $img_error = $Image['error'];

    if ($img_error == 0) {
        $dest_file = 'upload_image/' . $img_name;
        move_uploaded_file($img_Path, $dest_file);

        $insertQuery = "INSERT INTO banners(ban_id, ban_image) VALUES('$ID','$dest_file')";
        $query = mysqli_query($con, $insertQuery);

        if ($query) {
            $successMessage = "Insertion successful! Image uploaded.";
        } else {
            $successMessage = "Insertion failed. Please try again.";
        }
    } else {
        $successMessage = "Error in uploading the image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Banners</title>
  <link rel="stylesheet" href="css/addbanner.css">
  <script>
    // JavaScript to display image preview before upload
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block'; // Show the image preview
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</head>
<body>

  <div class="form-container">
    <form action="" method="POST" enctype="multipart/form-data">
      <h1>Add Banner to the Banner Section</h1>
      
      <div class="form-group">
        <label for="Ban_id">Banner ID</label>
        <input type="number" name="Ban_id" placeholder="Enter Banner ID" required>
      </div>

      <div class="form-group">
        <label for="ban_img">Choose Banner Image</label>
        <input type="file" name="ban_img" onchange="previewImage(event)" required>
      </div>

      <!-- Image preview container -->
      <div class="form-group">
        <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 100%; margin-top: 20px;">
      </div>

      <input type="submit" name="submit" value="Add Banner">
    </form>

    <!-- Success or Error message -->
    <?php if ($successMessage): ?>
      <div class="alert">
        <?php echo $successMessage; ?>
      </div>
    <?php endif; ?>

    <div class="check-now">
      <a href="banner_display.php">Check Now</a>
    </div>
  </div>

</body>
</html>
