<?php
include 'config/connection.php';

// Check if the form was submitted and 'id' is passed
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Sanitize input to prevent SQL injection
    $id = $con->real_escape_string($id);
    $fullname = $con->real_escape_string($fullname);
    $email = $con->real_escape_string($email);
    $phone = $con->real_escape_string($phone);
    $password = $con->real_escape_string($password);

    // Convert role to 1 for admin and 0 for user
    if ($role == 'admin') {
        $role = 1;
    } else {
        $role = 0;
    }

    // Update query
    $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', password='$password', role='$role' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo "User updated successfully!";
        header("Location: viewRegister.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating user: " . $con->error;
    }
} else {
    // Check if 'id' is passed via GET for pre-populating the form
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = $con->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "User not found!";
            exit();
        }
    } else {
        echo "No user ID provided!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="css/edituser.css">
</head>
<body>

 <!-- <h2>Edit User/Admin</h2> -->

<form action="edit_user.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    
    <div class="form-group">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" value="<?php echo $row['fullname']; ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $row['phone']; ?>" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" value="<?php echo $row['password']; ?>" required>
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="user" <?php if($row['role'] == 0) echo 'selected'; ?>>User</option>
            <option value="admin" <?php if($row['role'] == 1) echo 'selected'; ?>>Admin</option>
        </select>
    </div>

    <input type="submit" value="Update">
</form>

</body>
</html>
