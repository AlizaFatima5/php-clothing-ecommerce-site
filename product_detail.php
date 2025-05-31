<?php
session_start();
include("admin/config/connection.php");
// include 'addtocart.php';
include 'includes/header.php';
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    $stmt = mysqli_prepare($con, "SELECT * FROM products_details WHERE product_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['title']); ?> - Product Details</title>
    <meta name="description" content="<?php echo htmlspecialchars(substr($row['description'], 0, 150)); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/product_detail.css">
    <script src="assets/js/product_detail.js"></script>
    <link rel="stylesheet" href="assets/css/footer_style.css">
</head>
<body>

<div class="product-container" role="main">
    <div class="image-section">
        <img id="mainImage" class="main-image" src="admin/<?php echo htmlspecialchars($row['main_image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?> main image">
        <div class="gallery" role="list" aria-label="Product image thumbnails">
            <?php 
            $imageKeys = ['main_image', 'image1', 'image2', 'image3', 'image4'];
            foreach ($imageKeys as $index => $imgKey): 
                if (!empty($row[$imgKey])): ?>
                <img 
                    src="admin/<?php echo htmlspecialchars($row[$imgKey]); ?>" 
                    alt="<?php echo htmlspecialchars($row['title']) . " image " . ($index + 1); ?>" 
                    role="listitem"
                    onclick="swapImage(this)" 
                    tabindex="0"
                    onkeypress="if(event.key==='Enter'){swapImage(this)}"
                    <?php echo $index === 0 ? 'class="active"' : ''; ?>
                >
            <?php endif; endforeach; ?>
        </div>
    </div>

    <div class="details">
        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        <p><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>

        <div class="price-info">
            <span><strong>Final Price:</strong> Rs <?php echo number_format($row['final_price']); ?></span>
            <span class="expected-price">Rs <?php echo number_format($row['expected_price']); ?></span>
        </div>

        <p class="available-qty"><strong>Available Quantity:</strong> <?php echo intval($row['quantity']); ?></p>

        <div class="action-buttons">
          <form action="addtocart.php" method="GET">
  <label for="quantity"><strong>Qty:</strong></label>
  <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo intval($row['quantity']); ?>" aria-label="Quantity">

  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
  
  <button type="submit" style="color: white; background-color: grey;">
    <i class="fas fa-cart-plus"></i> Add to Cart
  </button>
</form>


              
                </a>
            <!-- </button> -->

            <a href="#" class="checkout" onclick="goToCheckout(<?php echo intval($row['product_id']); ?>); return false;">
                <i class="fas fa-bolt" aria-hidden="true"></i> Checkout Now
            </a>

            <a 
                href="https://wa.me/923176450772?text=<?php echo urlencode($row['title'] . ' for Rs ' . $row['final_price']); ?>" 
                target="_blank" 
                class="whatsapp-button" 
                rel="noopener noreferrer"
                aria-label="Order via WhatsApp"
            >
                <i class="fab fa-whatsapp" aria-hidden="true"></i> Order via WhatsApp
            </a>
        </div>

        <div class="accordion" role="region" aria-live="polite" aria-atomic="true">
            <div class="accordion-item">
                <button class="accordion-header" aria-expanded="false" aria-controls="careContent" id="careHeader" onclick="toggleAccordion(this)">
                    Care Instructions <i class="fas fa-chevron-down" aria-hidden="true"></i>
                </button>
                <div class="accordion-content" id="careContent" role="region" aria-labelledby="careHeader" aria-hidden="true">
                    <?php echo nl2br(htmlspecialchars($row['care_instruction'])); ?>
                </div>
            </div>
            <div class="accordion-item">
                <button class="accordion-header" aria-expanded="false" aria-controls="disclaimerContent" id="disclaimerHeader" onclick="toggleAccordion(this)">
                    Disclaimer <i class="fas fa-chevron-down" aria-hidden="true"></i>
                </button>
                <div class="accordion-content" id="disclaimerContent" role="region" aria-labelledby="disclaimerHeader" aria-hidden="true">
                    <?php echo nl2br(htmlspecialchars($row['disclaimer'])); ?>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>

<?php
include 'footer.php';
?>