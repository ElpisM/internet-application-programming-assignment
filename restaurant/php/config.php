<?php
// ============================================
// DATABASE CONFIGURATION
// Edit these settings to match your server
// ============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Your MySQL username
define('DB_PASS', '');            // Your MySQL password
define('DB_NAME', 'restaurant_db');

// Create connection
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");
    return $conn;
}

// Site settings
define('SITE_NAME', 'La Bella Cucina');
define('SITE_TAGLINE', 'Where Every Meal Tells a Story');
?>
