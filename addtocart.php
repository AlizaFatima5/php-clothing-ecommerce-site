<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
     header('location:login.php');
    exit();
}

include 'admin/config/connection.php';

$user_id = $_SESSION['user_id'];
// $ID = $_GET['product_id'] ?? null;

$ID = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

// phir apni logic yahan...

if ($ID) {
    $selectQuery = "SELECT * FROM products_details WHERE product_id = '$ID'";
    $query = mysqli_query($con, $selectQuery);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        $title = mysqli_real_escape_string($con, $result['title']);
        $description = mysqli_real_escape_string($con, $result['description']);
        $price = $result['final_price'];
        $image = $result['main_image'];
        $product_id = $result['product_id'];

        $checkQuery = "SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$user_id'";
        $checkRes = mysqli_query($con, $checkQuery);
        if (mysqli_num_rows($checkRes) == 0) {
            $insertQuery = "INSERT INTO cart (title, image, product_price, quantity, product_id, user_id)
                            VALUES ('$title', '$image', '$price', $quantity, '$product_id', '$user_id')";
            mysqli_query($con, $insertQuery);
        }
    }
}

$cartSelectQuery = "SELECT * FROM cart WHERE user_id = '$user_id'";
$cartResult = mysqli_query($con, $cartSelectQuery);

$total = 0;
while ($row = mysqli_fetch_assoc($cartResult)) {
    $total += $row['product_price'] * $row['quantity'];
}
$cartResult = mysqli_query($con, $cartSelectQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Your Cart</title>
<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background: #f1f3f6;
    margin: 0;
    padding: 0;
    color: #333;
  }

  h1 {
    text-align: center;
    margin: 40px 0 20px;
    font-size: 36px;
    color: #2d2d2d;
  }

  .main-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }

  .cart-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
  }

  .cart-table thead {
    background: #f9fafc;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.5px;
  }

  .cart-table th,
  .cart-table td {
    padding: 18px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
  }

  .cart-table img {
    width: 75px;
    height: 75px;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease;
  }

  .cart-table img:hover {
    transform: scale(1.05);
  }

  .delete-icon {
    color: #dc3545;
    font-size: 24px;
    text-decoration: none;
    transition: color 0.3s;
  }

  .delete-icon:hover {
    color: #a71d2a;
  }

  .cart-wrapper {
    display: flex;
    gap: 30px;
    margin-top: 40px;
    flex-wrap: wrap;
  }

  .order-note,
  .cart-totals {
    flex: 1;
    min-width: 320px;
    padding: 25px 30px;
    border-radius: 12px;
  }

  .order-note label {
    display: block;
    margin-bottom: 12px;
    font-weight: 600;
    font-size: 16px;
  }

  .order-note textarea {
    width: 100%;
    height: 110px;
    padding: 14px;
    font-size: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    resize: none;
    transition: border-color 0.3s ease;
  }

  .order-note textarea:focus {
    border-color: #007bff;
    outline: none;
  }

  .cart-totals h2 {
    margin-top: 0;
    margin-bottom: 25px;
    font-size: 24px;
    font-weight: 600;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
    color: #2c3e50;
  }

  .cart-totals .line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 14px;
    font-size: 16px;
    color: #555;
  }

  .cart-totals .total {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    margin-top: 15px;
    border-top: 1px solid #ddd;
    padding-top: 12px;
  }

  .btn-checkout {
    margin-top: 30px;
    display: inline-block;
    background: #007bff;
    color: #fff;
    padding: 14px 28px;
    text-decoration: none;
    border-radius: 8px;
    font-size: 17px;
    transition: background 0.3s ease, transform 0.2s ease;
  }

  .btn-checkout:hover {
    background: #0056b3;
    transform: scale(1.03);
  }

  .empty-msg {
    text-align: center;
    font-size: 20px;
    color: #888;
    padding: 50px 0 20px;
  }

  .btn-continue {
    display: block;
    margin: 10px auto 60px;
    background: #28a745;
    color: #fff;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 16px;
    width: fit-content;
    transition: background 0.3s ease;
  }

  .btn-continue:hover {
    background: #218838;
  }
</style>
</head>
<body>

<h1>Your Cart</h1>
<div class="main-container">
  <?php if (mysqli_num_rows($cartResult) > 0): ?>
    <table class="cart-table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Title</th>
          <th>Price (₹)</th>
          <th>Quantity</th>
          <th>Subtotal (₹)</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($item = mysqli_fetch_assoc($cartResult)): ?>
          <tr>
            <td><img src="admin/<?php echo htmlspecialchars($item['image']); ?>" alt=""></td>
            <td><?php echo htmlspecialchars($item['title']); ?></td>
            <td><?php echo number_format($item['product_price'], 2); ?></td>
            <td><?php echo (int)$item['quantity']; ?></td>
            <td><?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></td>
            <td><a href="delete_cart.php?product_id=<?php echo $item['product_id']; ?>" class="delete-icon" onclick="return confirm('Remove this item?');">&times;</a></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <div class="cart-wrapper">
      <div class="order-note">
        <label for="orderNote">Add Order Note:</label>
        <textarea id="orderNote" placeholder="How can we help you?"></textarea>
      </div>

      <div class="cart-totals">
        <h2>Cart Totals</h2>
        <div class="line">
          <span>Subtotal:</span>
          <span>₹<?php echo number_format($total, 2); ?></span>
        </div>
        <div class="line">
          <span>Shipping:</span>
          <span>Depends on location<br><small style="color:green;">(Free for nearby areas)</small></span>
        </div>
        <div class="total line">
          <span>Total:</span>
          <span>₹<?php echo number_format($total, 2); ?></span>
        </div>
        <a href="checkout.php" class="btn-checkout">Proceed to Checkout</a>
      </div>
    </div>

  <?php else: ?>
    <p class="empty-msg">Your cart is empty.</p>
    <a href="index.php" class="btn-continue">Continue Shopping</a>
  <?php endif; ?>
</div>

</body>
</html>
