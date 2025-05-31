<?php
session_start();

// Destroy all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Optional: Unset the session cookie if set
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page (or home page)
header("Location: login.php");
exit;
