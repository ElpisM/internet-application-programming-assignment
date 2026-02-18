# 🍽️ Restaurant Menu Website
**Built with:** PHP · MySQL · HTML · CSS · JavaScript

---

## 📁 Project Structure

```
restaurant/
├── index.php               ← Homepage with menu
├── login.php               ← Login page
├── register.php            ← Registration page
├── contact.php             ← Contact form
├── database.sql            ← Run this first to set up the database
├── css/
│   └── style.css           ← All styles
├── js/
│   └── main.js             ← All JavaScript
└── php/
    ├── config.php          ← Database settings (edit this!)
    ├── auth.php            ← Login & logout logic
    ├── register.php        ← Registration logic
    └── contact_handler.php ← Contact form logic
```

---

## 🚀 Setup Instructions (Step by Step)

### Step 1 — Install a local server
Download and install **XAMPP** (free): https://www.apachefriends.org/

### Step 2 — Copy project files
Paste the `restaurant/` folder into:
```
C:\xampp\htdocs\restaurant\     (Windows)
/Applications/XAMPP/htdocs/restaurant/  (Mac)
```

### Step 3 — Set up the database
1. Open XAMPP and start **Apache** and **MySQL**
2. Open your browser and go to: `http://localhost/phpmyadmin`
3. Click **Import** → Choose the `database.sql` file → Click **Go**

### Step 4 — Configure the database connection
Open `php/config.php` and update:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');    // Your MySQL username
define('DB_PASS', '');        // Your MySQL password (usually empty in XAMPP)
define('DB_NAME', 'restaurant_db');
```

### Step 5 — Open the website
Go to: **http://localhost/restaurant/**

---

## 🔑 Default Admin Login
- **Email:** admin@restaurant.com
- **Password:** password

> ⚠️ Change this password immediately after first login!

---

## ✨ Features
- 🍽️ **Dynamic Menu** — Menu loaded from database with category filtering
- 👤 **User Accounts** — Register, login, logout with secure password hashing
- 📬 **Contact Form** — Messages saved to the database
- 📱 **Responsive** — Works on mobile, tablet, and desktop
- 🔒 **Security** — Prepared statements (prevents SQL injection), password hashing

---

## 🛠️ How to Add Menu Items
1. Go to `http://localhost/phpmyadmin`
2. Open **restaurant_db** → **menu_items** table
3. Click **Insert** and fill in the details

---

## 📖 Next Steps to Learn
1. **Admin Panel** — Build a page where admins can add/edit/delete menu items
2. **Image Upload** — Allow uploading real food photos
3. **Online Ordering** — Add a cart and checkout system
4. **Email** — Use PHPMailer to send email confirmations
