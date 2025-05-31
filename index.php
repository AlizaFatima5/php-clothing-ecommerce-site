<?php
session_start();
include("admin/config/connection.php");
include ("includes/header.php");

// Banners
$selectQuery = "SELECT * FROM banners";
$bannerQuery = mysqli_query($con, $selectQuery);

// Categories
$CategoryQuery = "SELECT * FROM category";
$categoryQuery = mysqli_query($con, $CategoryQuery);

// New Arrivals (Latest 4)
$newArrivalsQuery = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";
$newArrivalsResult = mysqli_query($con, $newArrivalsQuery);

// Our Collection (Latest 8)
$collectionQuery = "SELECT * FROM products ORDER BY created_at DESC LIMIT 8";
$collectionResult = mysqli_query($con, $collectionQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
  <link rel="stylesheet" href="assets/css/banner_style.css" />
  <link rel="stylesheet" href="assets/css/category.css" />
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/footer_style.css">
</head>
<body>

<!-- ======= Banner Slider ======= -->
<div class="banner-slider">
  <button class="slider-btn left-btn" onclick="moveSlide(-1)">❮</button>
  <div class="banner-container" id="bannerContainer">
    <?php while($banner = mysqli_fetch_assoc($bannerQuery)) { ?>
      <img src="admin/<?php echo $banner['ban_image']; ?>" class="slide-image" alt="Banner Image">
    <?php } ?>
  </div>
  <button class="slider-btn right-btn" onclick="moveSlide(1)">❯</button>
</div>

<!-- ======= Category Section ======= -->
<div class="category_section">
  <h1 class="section_heading">UNSTITCHED</h1>
  <div class="container">
    <?php while ($cat = mysqli_fetch_assoc($categoryQuery)) { ?>
      <div class="item">
        <a href="shop.php" class="item-link">
          <img src="admin/<?php echo $cat['cat_image']; ?>" alt="Image not found" class="item-img">
          <div class="item-description">
            <p><?php echo $cat['cat_heading']; ?></p>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>
</div>

<!-- ======= New Arrivals Section ======= -->
<!-- ======= New Arrivals Section ======= -->
<div class="arrival">
  <h1 class="section-heading">NEW ARRIVALS</h1>
  <div class="product-grid">
    <?php while ($product = mysqli_fetch_assoc($newArrivalsResult)) { ?>
      <div class="product-card">
      <a href="product_detail.php">  <img src="admin/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title']; ?>"> </a>
        <div class="product-title"><?php echo $product['product_title']; ?></div>
        <div class="product-info">
          <span class="product-price">$<?php echo $product['price']; ?></span>
          <a href="addtocart.php?id=<?php echo $product['id']; ?>" class="cart-link">🛒</a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- ======= Our Collection Section ======= -->
<div class="collection">
  <h1 class="section-heading">OUR COLLECTION</h1>
  <div class="product-grid">
    <?php
    // SQL query mein ORDER BY aur LIMIT clause add karna
    $query = "SELECT * FROM products ORDER BY id ASC LIMIT 8"; // id ko ASC (ascending) order mein sort karo aur sirf 8 products laao
    $collectionResult = mysqli_query($con, $query); // Assuming $con aapka database connection hai

    // Ab products fetch karte hain
    while ($product = mysqli_fetch_assoc($collectionResult)) { ?>
      <div class="product-card">
       <a href="product_detail.php"> <img src="admin/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title']; ?>"></a>
        <div class="product-title"><?php echo $product['product_title']; ?></div>
        <div class="product-info">
          <span class="product-price">$<?php echo $product['price']; ?></span>
          <a href="addtocart.php?id=<?php echo $product['id']; ?>" class="cart-link">🛒</a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<!-- ======= Shop Now Button ======= -->
<div class="shop-now-container">
  <a href="shop.php" class="shop-now-btn">Explore Now</a>
</div>


<script src="assets/js/banner.js"></script>
</body>
</html>
<?php
include 'footer.php';
?>
