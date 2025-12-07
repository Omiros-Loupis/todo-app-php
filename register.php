<?php
require_once 'connect.php';
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error_msg = "Please fill in all fields.";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = :u");
        $stmt->execute([':u' => $username]);
        
        if ($stmt->fetch()) {
            $error_msg = "Username already taken.";
        } else {
            // Insert user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:u, :p)");
            if ($stmt->execute([':u' => $username, ':p' => $hashed])) {
                header("location: login.php");
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Register</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <h2>Create Account</h2>
    <?php if($error_msg) echo "<p class='error'>$error_msg</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body></html>