<?php
include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Banners</title>
  <link rel="stylesheet" href="css/bannerdisplay.css">
</head>
<body>
  <div class="container">
    <h1 class="page-title">Banners Section</h1>
    <table class="banner-table">
      <thead>
        <tr>
          <th>Banner ID</th>
          <th>Banner Image</th>
          <th>Operations</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $selectQuery="SELECT * FROM banners";
        $query=mysqli_query($con, $selectQuery);
        while ($result=mysqli_fetch_assoc($query)) {
        ?>
          <tr>
            <td><?php echo $result['ban_id']; ?></td>
            <td>
              <img src="<?php echo $result['ban_image']; ?>" alt="Banner Image" class="banner-img">
            </td>
            <td>
              <a href="edit_banner.php?id=<?php echo $result['id']; ?>" class="edit-btn">Edit</a>
              <a href="delete_banner.php?id=<?php echo $result['id']; ?>" class="delete-btn">Delete</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
