<?php
include "admin/config/connection.php";
$errors = [];
$successMessage = "";
$fullName = $email = $phone = $password = $repeatPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullname"])) {
        $errors['fullname'] = "Full name is required";
    } else {
        $fullName = htmlspecialchars($_POST["fullname"]);
    }

    if (empty($_POST["email"])) {
        $errors['email'] = "Email address is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["phone"])) {
        $errors['phone'] = "Phone number is required";
    } else {
        $phone = htmlspecialchars($_POST["phone"]);
    }

    if (empty($_POST["password"])) {
        $errors['password'] = "Password is required";
    } elseif (strlen($_POST["password"]) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    } else {
        $password = $_POST["password"];
    }

    if (empty($_POST["repeat_password"])) {
        $errors['repeat_password'] = "Please repeat your password";
    } elseif ($_POST["repeat_password"] !== $_POST["password"]) {
        $errors['repeat_password'] = "Passwords do not match";
    } else {
        $repeatPassword = $_POST["repeat_password"];
    }

    if (empty($errors)) {
        $stmt = $con->prepare("INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $email, $phone, $password); // No hashing here

        if ($stmt->execute()) {
            $successMessage = "Registered successfully!";
            $fullName = $email = $phone = "";
        } else {
            $errors['database'] = "Something went wrong. Please try again.";
        }

        $stmt->close();
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Account</title>
  <link rel="stylesheet" href="assets/css/signup_style.css"/>
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>
    <p>Get started with your free account</p>

    <?php if (!empty($successMessage)): ?>
      <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="text" name="fullname" placeholder="Full name" value="<?= htmlspecialchars($fullName) ?>" />
      <span class="error"><?= $errors['fullname'] ?? '' ?></span>

      <input type="email" name="email" placeholder="Email address" value="<?= htmlspecialchars($email) ?>" />
      <span class="error"><?= $errors['email'] ?? '' ?></span>

      <input type="tel" name="phone" placeholder="Phone number" value="<?= htmlspecialchars($phone) ?>" />
      <span class="error"><?= $errors['phone'] ?? '' ?></span>

      <input type="password" name="password" placeholder="Create password" />
      <span class="error"><?= $errors['password'] ?? '' ?></span>

      <input type="password" name="repeat_password" placeholder="Repeat password" />
      <span class="error"><?= $errors['repeat_password'] ?? '' ?></span>

      <button type="submit">Create Account</button>
    </form>
    <p class="login-link">Have an account? <a href="login.php">Log in</a></p>
  </div>
</body>
</html>
