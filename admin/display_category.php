<?php 
include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display_Category</title>
  <link rel="stylesheet" href="css/displaycategory.css">
</head>
<body>
  <table>
    
      <thead>
        <tr>
        <th>Image</th>
        <th>Heading</th>
        <th>Operations</th>
        </tr>
      </thead>
  <tbody>
    <?php
    $selectQuery="select * from category";
    $query=mysqli_query($con,$selectQuery);
    while($result=mysqli_fetch_assoc($query)){
    ?>
    <tr>
      <td><img src="<?php echo $result['cat_image']?>" alt="Something went wrong"></td>
    <td><?php echo $result['cat_heading']?></td>
    <td>
      <a href="edit_category.php?id=<?php echo $result['id']?>">Edit</a>
      <a href="delete_category.php?id=<?php echo $result['id']?>">Delete</a>
    </td>
    </tr>
<?php
}
?>
  </tbody>
  </table>
</body>
</html>