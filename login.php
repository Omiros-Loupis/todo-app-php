<?php
require_once 'connect.php';
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = :u");
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user['user_id'];
        $_SESSION["username"] = $user['username'];
        header("location: index.php");
        exit;
    } else {
        $error_msg = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if($error_msg) echo "<p class='error'>$error_msg</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>No account? <a href="register.php">Register</a></p>
</div>
</body></html>