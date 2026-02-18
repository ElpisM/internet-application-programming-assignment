<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    $error    = '';

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (strlen($username) < 3) {
        $error = "Username must be at least 3 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    }

    if (empty($error)) {
        $conn = getConnection();

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email or username already exists.";
        } else {
            // Hash the password securely
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'customer')");
            $stmt->bind_param("sss", $username, $email, $hashed);

            if ($stmt->execute()) {
                // Auto-login after registration
                $_SESSION['user_id']   = $conn->insert_id;
                $_SESSION['username']  = $username;
                $_SESSION['email']     = $email;
                $_SESSION['role']      = 'customer';
                $_SESSION['logged_in'] = true;

                header("Location: ../index.php?msg=registered");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
        $conn->close();
    }

    header("Location: ../register.php?error=" . urlencode($error));
    exit();
}
?>
