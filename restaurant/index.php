<?php
session_start();
require_once 'php/config.php';

// Fetch menu data from database
$conn = getConnection();

// Get all categories
$categories = $conn->query("SELECT * FROM categories ORDER BY display_order");

// Get all available menu items
$items_result = $conn->query("SELECT m.*, c.name AS category_name FROM menu_items m LEFT JOIN categories c ON m.category_id = c.id WHERE m.is_available = 1 ORDER BY c.display_order, m.name");

$items = [];
while ($row = $items_result->fetch_assoc()) {
    $items[] = $row;
}

$conn->close();

// Message handling
$message = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'welcome') $message = "Welcome back, " . htmlspecialchars($_SESSION['username']) . "!";
    if ($_GET['msg'] === 'registered') $message = "Account created! Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
    if ($_GET['msg'] === 'logged_out') $message = "You have been logged out successfully.";
}

// Category emojis (just for fun since we don't have real images)
$emojis = ['Starters' => '🥗', 'Main Course' => '🍽️', 'Desserts' => '🍰', 'Beverages' => '🥤'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - Restaurant Menu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVIGATION -->
<nav class="navbar">
    <div class="nav-inner">
        <div class="nav-logo"><?= SITE_NAME ?> <span>✦</span></div>
        <button class="nav-toggle" id="navToggle">☰</button>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['logged_in'])): ?>
                <li><a href="#">Hi, <?= htmlspecialchars($_SESSION['username']) ?> 👋</a></li>
                <li><a href="php/auth.php?action=logout" class="btn-nav">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="btn-nav">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- ALERTS -->
<?php if ($message): ?>
<div class="container" style="padding-top:20px;">
    <div class="alert alert-success"><?= $message ?></div>
</div>
<?php endif; ?>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">✦ Fine Dining Experience</div>
        <h1>Taste the Art of<br><em>Fine Cuisine</em></h1>
        <p><?= SITE_TAGLINE ?></p>
        <div class="hero-buttons">
            <a href="#menu" class="btn btn-primary">Explore Menu</a>
            <a href="contact.php" class="btn btn-outline">Reserve a Table</a>
        </div>
    </div>
</section>

<!-- MENU SECTION -->
<section class="section" id="menu">
    <div class="container">
        <div class="section-header">
            <span class="label">What We Offer</span>
            <h2>Our Menu</h2>
            <p>Crafted with the finest ingredients, every dish is a masterpiece</p>
        </div>

        <!-- Category Tabs -->
        <div class="menu-tabs">
            <button class="tab-btn active" data-category="all">All Items</button>
            <?php
            $categories->data_seek(0);
            while ($cat = $categories->fetch_assoc()):
            ?>
            <button class="tab-btn" data-category="<?= htmlspecialchars($cat['name']) ?>">
                <?= htmlspecialchars($cat['name']) ?>
            </button>
            <?php endwhile; ?>
        </div>

        <!-- Menu Cards -->
        <div class="menu-grid">
            <?php if (empty($items)): ?>
                <p style="color:var(--muted); grid-column:1/-1; text-align:center; padding:40px 0;">
                    No menu items available yet. Check back soon!
                </p>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <?php $emoji = $emojis[$item['category_name']] ?? '🍴'; ?>
                    <div class="menu-card <?= $item['is_available'] ? '' : 'card-unavailable' ?>"
                         data-category="<?= htmlspecialchars($item['category_name']) ?>">
                        <?php if ($item['is_featured']): ?>
                            <span class="card-badge">⭐ Featured</span>
                        <?php endif; ?>
                        <div class="card-img"><?= $emoji ?></div>
                        <div class="card-body">
                            <div class="card-category"><?= htmlspecialchars($item['category_name']) ?></div>
                            <h3 class="card-title"><?= htmlspecialchars($item['name']) ?></h3>
                            <p class="card-desc"><?= htmlspecialchars($item['description']) ?></p>
                            <div class="card-footer">
                                <span class="card-price">$<?= number_format($item['price'], 2) ?></span>
                                <?php if (!$item['is_available']): ?>
                                    <small style="color:var(--error); font-weight:700;">Unavailable</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. Made with ❤️ |
        <a href="contact.php">Contact Us</a>
    </p>
</footer>

<script src="js/main.js"></script>
</body>
</html>
