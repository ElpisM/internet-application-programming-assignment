<?php
session_start();
// Redirect if already logged in
if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - La Bella Cucina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">

    <div class="auth-card">
        <div class="logo">La Bella <span>Cucina</span></div>
        <div class="subtitle">Sign in to your account</div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="php/auth.php">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; border-radius:8px;">
                Sign In
            </button>
        </form>

        <div class="auth-link">
            Don't have an account? <a href="register.php">Sign Up</a>
        </div>
        <div class="auth-link" style="margin-top:10px;">
            <a href="index.php">← Back to Menu</a>
        </div>
    </div>

<script src="js/main.js"></script>
</body>
</html>
