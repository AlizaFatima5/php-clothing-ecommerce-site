<?php
session_start();
include 'admin/config/connection.php';

$errors = [];
$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email)) {
        $errors['email'] = "Email is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on role
            if (is_null($user['role']) || $user['role'] == 0) {
                header("Location: index.php");
                exit;
            } elseif ($user['role'] == 1) {
                header("Location: admin/index.php");
                exit;
            } else {
                // Optional: handle unknown roles
                $errors['login'] = "Invalid user role.";
            }
        } else {
            $errors['login'] = "Incorrect email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/login-style.css" />
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <p>Welcome back! Please login to your account.</p>

    <?php if (!empty($errors['login'])): ?>
      <p class="error"><?= $errors['login'] ?></p>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="email" name="email" placeholder="Email address" value="<?= htmlspecialchars($email) ?>" required />
      <span class="error"><?= $errors['email'] ?? '' ?></span>

      <input type="password" name="password" placeholder="Password" required />
      <span class="error"><?= $errors['password'] ?? '' ?></span>

      <button type="submit">Login</button>
    </form>

    <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
  </div>
</body>
</html>
