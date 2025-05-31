<?php
include 'config/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM users WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('User Deleted Successfully!'); window.location.href='viewRegister.php';</script>";
    } else {
        echo "Error deleting record: " . $con->error;
    }
} else {
    echo "Invalid Request!";
}
?>
