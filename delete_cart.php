<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit("Unauthorized access.");
}

include 'admin/config/connection.php';

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'] ?? null;

if ($product_id) {
    // Safe deletion using prepared statement
    $stmt = $con->prepare("DELETE FROM cart WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $product_id, $user_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: addtocart.php"); // Redirect without showing anything
exit();
?>