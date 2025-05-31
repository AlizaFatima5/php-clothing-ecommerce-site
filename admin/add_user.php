<?php
include 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Secure password hash
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Role conversion
    $roleValue = ($role === 'admin') ? 1 : 0;

    $sql = "INSERT INTO users (fullname, email, phone, password, role) 
            VALUES ('$fullname', '$email', '$phone', '$hashedPassword', '$roleValue')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('New User/Admin Added Successfully!'); window.location.href='viewRegister.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User/Admin</title>
    <link rel="stylesheet" href="css/adduser.css">
</head>
<body>

<div class="form-container">
    <h2>Add New User/Admin</h2>
    <form action="" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <input type="submit" value="Add User/Admin">
    </form>
</div>

</body>
</html>
