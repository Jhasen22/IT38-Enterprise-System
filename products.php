<?php
session_start();
// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Sample product data
$products = [
    [
        'id' => 1,
        'name' => 'Stanley Adjustable Wrench Set',
        'description' => 'A high-quality set of adjustable wrenches designed for durability and precision.',
        'price' => 142.00,
        'rating' => '✧ ✧ ✧ ✧'
    ],
    [
        'id' => 2,
        'name' => 'Black & Decker Electric Drill',
        'description' => 'A powerful electric drill for professional and home use.',
        'price' => 342.00,
        'rating' => '✧ ✧ ✧ ✧'
    ],
    [
        'id' => 3,
        'name' => 'Castillo Claw Hammer',
        'description' => 'Professional claw hammer with rubberized grip.',
        'price' => 242.00,
        'rating' => '✧ ✧ ✧ ✧'
    ],
    [
        'id' => 4,
        'name' => 'Hampax Handsaw',
        'description' => 'Manual cutting tool with sharp steel blade.',
        'price' => 89.00,
        'rating' => '✧ ✧ ✧ ✧'
    ]
];

// Process Add to Cart or Buy Now actions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product = null;
    
    // Find the selected product
    foreach ($products as $p) {
        if ($p['id'] == $product_id) {
            $product = $p;
            break;
        }
    }
    
    if ($product) {
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Add to cart
        if (isset($_POST['add_to_cart'])) {
            // Check if product already in cart
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $product_id) {
                    $item['quantity'] += 1;
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => 1
                ];
            }
            
            header("Location: cart.php");
            exit();
        }
        // Buy Now
        elseif (isset($_POST['buy_now'])) {
            // Clear cart and add single item
            $_SESSION['cart'] = [
                [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => 1
                ]
            ];
            
            header("Location: checkout.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HardwareHub - Products</title>
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
            text-align: center;
        }
        .subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 2rem;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }
        .product-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .product-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }
        .product-description {
            color: #7f8c8d;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        .product-rating {
            color: #f39c12;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        .product-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 1.5rem;
        }
        .button-group {
            display: flex;
            gap: 0.5rem;
        }
        .cart-btn, .buy-now-btn {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
        }
        .cart-btn {
            background-color: #3498db;
            color: white;
        }
        .cart-btn:hover {
            background-color: #2980b9;
        }
        .buy-now-btn {
            background-color: #2ecc71;
            color: white;
        }
        .buy-now-btn:hover {
            background-color: #27ae60;
        }
        .divider {
            border: 0;
            height: 1px;
            background-color: #ddd;
            margin: 2rem 0;
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
        <h1 class="page-title">PRODUCTS</h1>
        <p class="subtitle">CREATE FOR TEXTILENCE PROCESSES</p>
        
        <div class="divider"></div>
        
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="product-rating"><?php echo $product['rating']; ?></div>
                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <div class="button-group">
                            <button type="submit" name="add_to_cart" class="cart-btn">Add to Cart</button>
                            <button type="submit" name="buy_now" class="buy-now-btn">Buy Now</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>