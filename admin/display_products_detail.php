<?php
include 'config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Display Product Details</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid black;
      padding: 10px;
      text-align: center;
    }
    img {
      width: 100px;
      height: auto;
    }
    .btn {
      padding: 5px 10px;
      text-decoration: none;
      border: 1px solid #333;
      border-radius: 4px;
    }
    .edit-btn { background-color: lightblue; }
    .delete-btn { background-color: lightcoral; }
  </style>
</head>
<body>

<h2>Product Details</h2>

<table>
  <thead>
    <tr>
      <th>Product ID</th>
      <th>Title</th>
      <th>Description</th>
      <th>Final Price</th>
      <th>Expected Price</th>
      <th>Quantity</th>
      <th>Main Image</th>
      <th colspan="4">Gallery Images</th>
      <th>Care Instruction</th>
      <th>Disclaimer</th>
      <th>Created At</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <tr>
      <th colspan="7"></th>
      <th colspan="4"><strong>Gallery Images</strong></th>
      <th colspan="5"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM products_details";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <td><?php echo $row['product_id']; ?></td>
      <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['description']; ?></td>
      <td><?php echo $row['final_price']; ?></td>
      <td><?php echo $row['expected_price']; ?></td>
      <td><?php echo $row['quantity']; ?></td>
      <td><img src="<?php echo $row['main_image']; ?>" alt="Main Image"></td>
      <td><img src="<?php echo $row['image1']; ?>" alt="Image 1"></td>
      <td><img src="<?php echo $row['image2']; ?>" alt="Image 2"></td>
      <td><img src="<?php echo $row['image3']; ?>" alt="Image 3"></td>
      <td><img src="<?php echo $row['image4']; ?>" alt="Image 4"></td>
      <td><?php echo $row['care_instruction']; ?></td>
      <td><?php echo $row['disclaimer']; ?></td>
      <td><?php echo $row['created_at']; ?></td>
      <td>
        <a class="btn edit-btn" href="edit_product_detail.php?id=<?php echo $row['id']; ?>">Edit</a>
      </td>
      <td>
        <a class="btn delete-btn" href="delete_product_detail.php?id=<?php echo $row['id']; ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

</body>
</html>
