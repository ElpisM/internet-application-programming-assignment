<?php
session_start();
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
    <title>Register - La Bella Cucina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">

    <div class="auth-card">
        <div class="logo">La Bella <span>Cucina</span></div>
        <div class="subtitle">Create your account</div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="php/register.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required minlength="3">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 6 characters" required minlength="6">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; border-radius:8px;">
                Create Account
            </button>
        </form>

        <div class="auth-link">
            Already have an account? <a href="login.php">Sign In</a>
        </div>
        <div class="auth-link" style="margin-top:10px;">
            <a href="index.php">← Back to Menu</a>
        </div>
    </div>

<script src="js/main.js"></script>
</body>
</html>
