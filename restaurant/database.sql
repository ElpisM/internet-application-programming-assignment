-- ============================================
-- RESTAURANT MENU WEBSITE - DATABASE SETUP
-- Run this file once to set up your database
-- ============================================

CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

-- Users table (for login)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menu categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    display_order INT DEFAULT 0
);

-- Menu items table
CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    is_available BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Contact messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- SAMPLE DATA
-- ============================================

-- Insert categories
INSERT INTO categories (name, description, display_order) VALUES
('Starters', 'Light bites to begin your journey', 1),
('Main Course', 'Hearty and satisfying mains', 2),
('Desserts', 'Sweet endings to your meal', 3),
('Beverages', 'Refreshing drinks and cocktails', 4);

-- Insert menu items
INSERT INTO menu_items (category_id, name, description, price, is_featured) VALUES
(1, 'Garlic Bread', 'Toasted bread with garlic butter and herbs', 3.99, FALSE),
(1, 'Bruschetta', 'Grilled bread rubbed with garlic, topped with fresh tomatoes and basil', 6.50, TRUE),
(1, 'Soup of the Day', 'Ask your waiter for today\'s special soup', 5.99, FALSE),
(2, 'Grilled Chicken', 'Free-range chicken breast with seasonal vegetables and mashed potatoes', 14.99, TRUE),
(2, 'Beef Burger', 'Juicy beef patty with lettuce, tomato, cheese and fries', 12.50, FALSE),
(2, 'Veggie Pasta', 'Penne pasta with roasted vegetables in a rich tomato sauce', 10.99, FALSE),
(2, 'Grilled Salmon', 'Fresh salmon fillet with lemon butter sauce and steamed rice', 18.99, TRUE),
(3, 'Chocolate Cake', 'Rich dark chocolate cake with vanilla ice cream', 5.99, FALSE),
(3, 'Cheesecake', 'Creamy New York-style cheesecake with berry compote', 6.50, TRUE),
(4, 'Fresh Juice', 'Orange, mango, or passion fruit - freshly squeezed', 3.50, FALSE),
(4, 'Coffee', 'Espresso, cappuccino, or latte', 2.99, FALSE),
(4, 'Mineral Water', 'Still or sparkling', 1.99, FALSE);

-- Insert a default admin user (password: admin123)
-- In production, always change this password!
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@restaurant.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
