<?php
include 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/displaycategory.css">
  <title>Display_Products</title>
</head>
<body>
  <thead>
    <tr>
      <th>Product_ID</th>
      <th>Product_Image</th>
      <th>Product_title</th>
      <th>Product_Price</th>
      <th>Operations</th>
    </tr>
  </thead>
  <tbody>
  <h1>ALL Products</h1>
<table><?php
$selectQuery="select * from products";
$query=mysqli_query($con,$selectQuery);
while($result=mysqli_fetch_assoc($query)){
?>
    <tr>
      <td><?php echo $result['product_id']?></td>
      <td><img src="<?php echo $result['product_image']?>" alt=""></td>
      <td><?php echo $result['product_title']?></td>
      <td><?php echo $result['price']?></td>
      <td>
        <a href="edit_products.php?id=<?php echo $result['id']?>;">Edit</a>
          <a href="delete_product.php?id=<?php echo $result['id']?>"> Delete</a>
        </a>
      </td>
    </tr>
<?php
}
?>
</tbody>
</table>

</body>
</html>