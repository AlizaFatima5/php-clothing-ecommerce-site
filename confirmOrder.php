<?php
session_start();
include 'admin/config/connection.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please login.");
}

$user_id = (int)$_SESSION['user_id']; // cast for security

// Handle order placement
if (isset($_POST['place_order'])) {

    // Get latest checkout info of this user using prepared statement
    $stmtChk = $con->prepare("
        SELECT firstname, lastname, street_address, city, country, phone, email_address
        FROM checkout
        WHERE user_id = ?
        ORDER BY id DESC
        LIMIT 1
    ");
    $stmtChk->bind_param("i", $user_id);
    $stmtChk->execute();
    $resultChk = $stmtChk->get_result();
    $chk = $resultChk->fetch_assoc();
    $stmtChk->close();

    if (!$chk) {
        die("Checkout info not found for user.");
    }

    // Fetch this user's cart items using prepared statement
    $stmtCart = $con->prepare("SELECT title, image, product_price, quantity FROM cart WHERE user_id = ?");
    $stmtCart->bind_param("i", $user_id);
    $stmtCart->execute();
    $cartResult = $stmtCart->get_result();

    if ($cartResult->num_rows === 0) {
        die("Cart is empty.");
    }

    // Prepare statement for order insert (with order_date)
    $stmtOrder = $con->prepare("
        INSERT INTO orders 
        (user_id, firstname, lastname, street_address, city, country,
         phone, email_address, item_title, item_image, item_price, item_quantity, order_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmtOrder) {
        die("Prepare failed: (" . $con->errno . ") " . $con->error);
    }

    // Bind params (types: i=integer, s=string, d=double)
    $stmtOrder->bind_param(
        "isssssssssdis",
        $user_id,
        $chk['firstname'],
        $chk['lastname'],
        $chk['street_address'],
        $chk['city'],
        $chk['country'],
        $chk['phone'],
        $chk['email_address'],
        $item_title,
        $item_image,
        $item_price,
        $item_qty,
        $order_date
    );

    // Insert each cart item with current date/time
    while ($row = $cartResult->fetch_assoc()) {
        $item_title = $row['title'];
        $item_image = $row['image'];
        $item_price = floatval($row['product_price']);
        $item_qty   = intval($row['quantity']);
        $order_date = date('Y-m-d H:i:s'); // current datetime

        if (!$stmtOrder->execute()) {
            die("Order insert failed: (" . $stmtOrder->errno . ") " . $stmtOrder->error);
        }
    }

    $stmtOrder->close();
    $stmtCart->close();

    // Clear cart using prepared statement
    $stmtClear = $con->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmtClear->bind_param("i", $user_id);
    $stmtClear->execute();
    $stmtClear->close();

    header('Location: final.php');
    exit;
}

// Get checkout info for display (prepared statement)
$stmtDisplayChk = $con->prepare("
    SELECT firstname, lastname, street_address, city, country, phone, email_address
    FROM checkout
    WHERE user_id = ?
    ORDER BY id DESC
    LIMIT 1
");
$stmtDisplayChk->bind_param("i", $user_id);
$stmtDisplayChk->execute();
$resDisplayChk = $stmtDisplayChk->get_result();
$cust = $resDisplayChk->fetch_assoc();
$stmtDisplayChk->close();

if (!$cust) {
    die("Checkout info not found for user.");
}

// Get user's cart items (prepared statement)
$stmtCartItems = $con->prepare("SELECT title, product_price, quantity, image FROM cart WHERE user_id = ?");
$stmtCartItems->bind_param("i", $user_id);
$stmtCartItems->execute();
$resCartItems = $stmtCartItems->get_result();
$cartItems = $resCartItems->fetch_all(MYSQLI_ASSOC);
$stmtCartItems->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Your Order</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f7f9fb; padding: 20px; color: #333; }
    .container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    h2 { color: #444; margin-top: 0; }
    .read-note { background: #fffbf5; border-left: 4px solid #ff6a00; padding: 16px 20px; margin-bottom: 24px; }
    .read-note p { margin: 6px 0; }
    .product-preview { margin-bottom: 24px; }
    .item { display: flex; align-items: center; margin-bottom: 15px; }
    .item img { width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd; border-radius: 4px; margin-right: 15px; }
    .item-details { flex: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .item-details label { font-weight: 600; font-size: 14px; }
    .item-details input { width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px; background: #f5f5f5; }
    .btn { display: inline-block; padding: 12px 28px; background: #ff6a00; color: #fff; text-decoration: none; border-radius: 25px; border: none; cursor: pointer; transition: background .2s ease; }
    .btn:hover { background: #e65c00; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Confirm Your Order</h2>

    <!-- Personal Info Preview -->
    <div class="read-note">
      <p><strong>Name:</strong> <?= htmlspecialchars($cust['firstname'] . ' ' . $cust['lastname']) ?></p>
      <p><strong>Address:</strong> <?= htmlspecialchars($cust['street_address'] . ', ' . $cust['city'] . ', ' . $cust['country']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($cust['phone']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($cust['email_address']) ?></p>
    </div>

    <!-- Product Details -->
    <div class="product-preview">
      <?php foreach ($cartItems as $item): ?>
        <div class="item">
          <img src="admin/<?= htmlspecialchars($item['image']) ?>" alt="Product Image">
          <div class="item-details">
            <label>Title</label>
            <input type="text" value="<?= htmlspecialchars($item['title']) ?>" readonly>

            <label>Quantity</label>
            <input type="text" value="<?= (int)$item['quantity'] ?>" readonly>

            <label>Unit Price</label>
            <input type="text" value="PKR <?= number_format($item['product_price']) ?>" readonly>

            <label>Subtotal</label>
            <input type="text" value="PKR <?= number_format($item['product_price'] * $item['quantity']) ?>" readonly>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Confirm Order Button -->
    <form method="POST">
      <button type="submit" name="place_order" class="btn">Confirm Order</button>
    </form>
  </div>
</body>
</html>
