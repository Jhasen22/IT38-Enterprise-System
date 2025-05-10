<?php
session_start();
// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HardwareHub - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
        }
        .hero {
            background-color: #f4f4f9;
            padding: 4rem 2rem;
            text-align: center;
        }
        .hero h1 {
            font-size: 2.5rem;
            color: #2c3e50;
        }
        .hero p {
            font-size: 1.2rem;
            color: #7f8c8d;
            max-width: 800px;
            margin: 1rem auto;
        }
        .cta-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">HardwareHub</div>
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="products.php">Products</a>
            <a href="about.php">About us</a>
            <a href="contacts.php">Contacts</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="hero">
        <h1>Tools you trust, service you deserve.</h1>
        <p>Explore our high-quality products designed for every builder's needs.</p>
        <a href="products.php" class="cta-button">Browse Our Best Deals</a>
    </div>
</body>
</html>