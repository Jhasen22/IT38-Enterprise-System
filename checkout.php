<?php
session_start();
// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Sample cart data - in a real app this would come from session or database
$cart_items = [
    [
        'name' => 'Stanley Adjustable Wrench Set',
        'price' => 142.00,
        'quantity' => 1
    ],
    [
        'name' => 'Black & Decker Electric Drill',
        'price' => 142.00,
        'quantity' => 1
    ],
    [
        'name' => 'Castillo Claw Hammer',
        'price' => 242.00,
        'quantity' => 1
    ]
];

// Calculate subtotal
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HardwareHub - Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
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
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .page-title {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        .checkout-container {
            display: flex;
            gap: 2rem;
        }
        .products-section, .details-section {
            flex: 1;
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .section-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #ddd;
        }
        .product-list {
            list-style-type: none;
            padding: 0;
        }
        .product-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .product-name {
            color: #2c3e50;
        }
        .product-price {
            color: #27ae60;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .payment-method {
            margin-bottom: 1rem;
        }
        .payment-method input {
            margin-right: 0.5rem;
        }
        .subtotal {
            font-size: 1.2rem;
            text-align: right;
            margin: 1.5rem 0;
        }
        .subtotal-amount {
            font-weight: bold;
            color: #27ae60;
        }
        .place-order-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
        }
        .place-order-btn:hover {
            background-color: #2980b9;
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

    <div class="container">
        <h1 class="page-title">CHECKOUT</h1>
        
        <div class="checkout-container">
            <!-- Products Section -->
            <div class="products-section">
                <h2 class="section-title">Products</h2>
                <ul class="product-list">
                    <?php foreach ($cart_items as $item): ?>
                        <li class="product-item">
                            <span class="product-name"><?php echo htmlspecialchars($item['name']); ?></span>
                            <span class="product-price">$<?php echo number_format($item['price'], 2); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Customer Details Section -->
            <div class="details-section">
                <h2 class="section-title">Check Out</h2>
                
                <form action="process_order.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Payment Method</label>
                        <div class="payment-method">
                            <input type="radio" id="cod" name="payment" value="cod" checked>
                            <label for="cod">Cash on delivery</label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="credit" name="payment" value="credit">
                            <label for="credit">Credit Card</label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="paypal" name="payment" value="paypal">
                            <label for="paypal">PayPal</label>
                        </div>
                    </div>
                    
                    <div class="subtotal">
                        Subtotal: <span class="subtotal-amount">$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    
                    <button type="submit" class="place-order-btn">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>