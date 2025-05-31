<?php
session_start();
include("admin/config/connection.php");
include("includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/shop.css">
  <link rel="stylesheet" href="assets/css/footer_style.css">
  <title>All Products</title>
</head>
<body>
 
  <div class="product-grid">
  <?php
  $selectQuery = "SELECT * FROM products";
  $query = mysqli_query($con, $selectQuery);
  while ($result = mysqli_fetch_assoc($query)) {
  ?>
    <div class="product-card">
      <!-- Wrap image with a link to image_description.php with product_id -->
     <a href="product_detail.php?product_id=<?php echo $result['product_id']; ?>">
  <img src="admin/<?php echo $result['product_image']; ?>" alt="Product Image">
</a>

      <h3 class="product-title"><?php echo $result['product_title']; ?></h3>
      <div class="product-info">
        <span class="product-price">Rs <?php echo $result['price']; ?></span>
        <a href="cart.php" class="cart-link" title="Add to Cart">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </div>
    </div>
  <?php
  }
  ?>
</div>

  
</body>
</html>
<?php
include 'footer.php';
?>