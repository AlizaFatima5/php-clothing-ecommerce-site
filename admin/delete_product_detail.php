<?php
include 'config/connection.php';

// if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL injection safe query
    $id = mysqli_real_escape_string($con, $id);

    $deleteQuery = "DELETE FROM products_details WHERE id = $id";
    $result = mysqli_query($con, $deleteQuery);

    if ($result) {
        // Redirect after successful deletion
        header("Location:display_products_detail.php");
        exit();
    } else {
        echo "Failed to delete the product.";
    }
// else {
//     echo "Invalid Request.";
// }
?>
