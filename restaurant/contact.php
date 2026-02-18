<?php
session_start();
$error   = isset($_GET['error'])   ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? true : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - La Bella Cucina</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVIGATION -->
<nav class="navbar">
    <div class="nav-inner">
        <div class="nav-logo"><a href="index.php" style="color:var(--primary);">La Bella Cucina <span style="color:white;">✦</span></a></div>
        <button class="nav-toggle">☰</button>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#menu">Menu</a></li>
            <li><a href="contact.php" class="active">Contact</a></li>
            <?php if (isset($_SESSION['logged_in'])): ?>
                <li><a href="#">Hi, <?= htmlspecialchars($_SESSION['username']) ?></a></li>
                <li><a href="php/auth.php?action=logout" class="btn-nav">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="btn-nav">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="label">Get in Touch</span>
            <h2>Contact Us</h2>
            <p>We'd love to hear from you — reservations, feedback, or just a hello!</p>
        </div>

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <h3>Visit Us</h3>
                <p>Open every day of the week, ready to make your experience unforgettable.</p>

                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-text">
                        <strong>Address</strong>
                        <span>123 Gourmet Avenue, Nairobi, Kenya</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div class="info-text">
                        <strong>Phone</strong>
                        <span>+254 712 345 678</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✉️</div>
                    <div class="info-text">
                        <strong>Email</strong>
                        <span>hello@labellacucina.com</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">🕐</div>
                    <div class="info-text">
                        <strong>Hours</strong>
                        <span>Mon–Sun: 10:00 AM – 10:00 PM</span>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        ✅ Message sent! We'll get back to you within 24 hours.
                    </div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-error"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="php/contact_handler.php">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="e.g. Table reservation for 4">
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <p>&copy; <?= date('Y') ?> La Bella Cucina | <a href="index.php">← Back to Menu</a></p>
</footer>

<script src="js/main.js"></script>
</body>
</html>
