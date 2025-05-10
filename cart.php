<?php
session_start();
// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Sample cart data - in a real app this would come from a database or session
$cart_items = [
    [
        'name' => 'Stanley Adjustable Wrench Set',
        'price' => 5122.00,
        'quantity' => 1
    ],
    [
        'name' => 'Black & Decker Electric Drill',
        'price' => 5542.00,
        'quantity' => 2
    ],
    [
        'name' => 'Castillo Claw Hammer',
        'price' => 5242.00,
        'quantity' => 3
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
    <title>HardwareHub - Shopping Cart</title>
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
            margin-bottom: 2rem;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .cart-table th {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            text-align: left;
        }
        .cart-table td {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }
        .cart-table tr:last-child td {
            border-bottom: none;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            background-color: #e0e0e0;
            border: none;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }
        .quantity-control input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
        }
        .subtotal {
            text-align: right;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .subtotal-amount {
            font-weight: bold;
            color: #27ae60;
        }
        .checkout-btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            float: right;
        }
        .checkout-btn:hover {
            background-color: #2980b9;
        }
        .empty-cart {
            text-align: center;
            padding: 2rem;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        <h1 class="page-title">Shopping Cart</h1>
        
        <?php if (count($cart_items) > 0): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <div class="quantity-control">
                                    <button>-</button>
                                    <input type="text" value="<?php echo $item['quantity']; ?>">
                                    <button>+</button>
                                </div>
                            </td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="subtotal">
                Subtotal: <span class="subtotal-amount">$<?php echo number_format($subtotal, 2); ?></span>
            </div>
            
            <a href="checkout.php" class="checkout-btn">Checkout</a>
            <div style="clear: both;"></div>
        <?php else: ?>
            <div class="empty-cart">
                <p>Your shopping cart is empty</p>
                <a href="products.php" class="checkout-btn">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>