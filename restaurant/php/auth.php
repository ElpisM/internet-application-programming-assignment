<?php
session_start();
require_once 'config.php';

// ============================================
// LOGOUT
// ============================================
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: ../index.php?msg=logged_out");
    exit();
}

// ============================================
// LOGIN
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $error    = '';

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $conn = getConnection();

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful - save user info in session
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['username']  = $user['username'];
                $_SESSION['email']     = $user['email'];
                $_SESSION['role']      = $user['role'];
                $_SESSION['logged_in'] = true;

                header("Location: ../index.php?msg=welcome");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }

        $stmt->close();
        $conn->close();
    }

    // If error, redirect back to login page with error
    header("Location: ../login.php?error=" . urlencode($error));
    exit();
}
?>
