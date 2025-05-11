<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Example of product data
$products = [
    [
        "name" => "Stanley Adjustable Wrench Set",
        "description" => "A high-quality set of adjustable wrenches designed for durability and precision. Provide a strong grip and easy adjustment for various bolt sizes.",
        "price" => "$142",
        "image" => "https://storage.googleapis.com/a1aa/image/0074ac10-e9e1-4161-e6bd-0ef71d353467.jpg",
        "rating" => 5
    ],
    [
        "name" => "Castile Claw Hammer",
        "description" => "A reliable claw hammer built for both professional and DIY use. Its steel head provides powerful striking force, while the rubberized grip ensures comfort and control.",
        "price" => "$242",
        "image" => "https://storage.googleapis.com/a1aa/image/6438f918-13a5-44a5-01ea-cbfaf26fffb2.jpg",
        "rating" => 5
    ],
    [
        "name" => "Black & Decker Electric Drill",
        "description" => "A powerful electric drill designed for professionals and DIYers. With its compact design and ergonomic grip, it ensures precision drilling in wood, metal, and concrete.",
        "price" => "$542",
        "image" => "https://storage.googleapis.com/a1aa/image/455a440e-455c-48bb-89cf-9e4a74d25095.jpg",
        "rating" => 5
    ],
    [
        "name" => "Hanpex Handsaw",
        "description" => "A manual cutting tool with a sharp toothed blade. The teeth vary in size depending on the type of cut needed, with larger teeth for rough cuts and finer teeth for precise cuts.",
        "price" => "$342",
        "image" => "https://storage.googleapis.com/a1aa/image/cc21c30b-56b2-4e30-6d4f-b2fd9e06cfef.jpg",
        "rating" => 3
    ]
];

// Handle adding to cart
if (isset($_GET['add_to_cart'])) {
    $product_name = urldecode($_GET['add_to_cart']);
    $product_found = null;
    
    // Find the product in our array
    foreach ($products as $product_item) {
        if ($product_item['name'] === $product_name) {
            $product_found = $product_item;
            break;
        }
    }
    
    if ($product_found) {
        // Check if product already exists in cart
        $item_exists = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['name'] === $product_found['name']) {
                $cart_item['quantity'] += 1;
                $item_exists = true;
                break;
            }
        }
        
        if (!$item_exists) {
            $_SESSION['cart'][] = [
                'name' => $product_found['name'],
                'price' => floatval(str_replace('$', '', $product_found['price'])),
                'quantity' => 1,
                'image' => $product_found['image']
            ];
        }
    }
    
    // Redirect to prevent duplicate additions
    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>HardwareHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#dbe3ea] to-[#f0f4f8] min-h-screen p-6">
<header class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-6 sm:gap-0">
    <div class="flex items-center gap-2">
        <img alt="HardwareHub logo" class="w-10 h-10" src="https://storage.googleapis.com/a1aa/image/b8cde2be-fb92-44f5-8f24-cc368489a6ab.jpg"/>
        <span class="font-extrabold text-sm text-[#1a1a1a] select-none">HardwareHub</span>
    </div>
    <nav class="flex gap-8 text-sm font-extrabold text-[#1a1a1a]">
        <a class="hover:underline" href="home.php">Home</a>
        <a class="underline decoration-[#2f6ce5] decoration-2" href="products.php">Products</a>
        <a class="hover:underline" href="about.php">About us</a>
        <a class="hover:underline" href="#">Contacts</a>
    </nav>
    <a href="cart.php" class="text-[#f97316] text-xl relative">
        <i class="fas fa-shopping-cart"></i>
        <?php if (!empty($_SESSION['cart'])): ?>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                <?php echo array_reduce($_SESSION['cart'], function($total, $item) { return $total + $item['quantity']; }, 0); ?>
            </span>
        <?php endif; ?>
    </a>
</header>

<div class="max-w-7xl mx-auto mt-6">
    <form class="max-w-xs">
        <label class="sr-only" for="search">Search for hand tools materials</label>
        <div class="relative">
            <input class="w-full pl-9 pr-3 py-2 rounded-full bg-[#7a7a7a]/30 placeholder:text-white placeholder:text-xs text-white text-xs focus:outline-none" id="search" placeholder="Search for hand tools materials...." type="search"/>
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white text-xs">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </form>
</div>

<main class="max-w-7xl mx-auto mt-10 bg-white rounded-xl p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <?php foreach ($products as $product): ?>
        <article class="bg-[#f3f3f3] rounded-xl p-4 flex flex-col items-center text-center">
            <img alt="<?= htmlspecialchars($product['name']) ?>" class="mb-4" height="120" src="<?= htmlspecialchars($product['image']) ?>" width="150"/>
            <h3 class="font-extrabold text-xs text-[#1a1a1a] mb-1"><?= htmlspecialchars($product['name']) ?></h3>
            <p class="text-[9px] text-[#1a1a1a] font-bold mb-1">Description:</p>
            <p class="text-[8px] text-[#1a1a1a] mb-2"><?= htmlspecialchars($product['description']) ?></p>
            <div class="text-[#f97316] text-xs mb-2">
                <?php for ($i = 0; $i < $product['rating']; $i++): ?>
                    <i class="fas fa-star"></i>
                <?php endfor; ?>
            </div>
            <div class="flex items-center gap-2 justify-center text-xs font-extrabold text-[#1a1a1a] mb-2">
                <span><?= htmlspecialchars($product['price']) ?></span>
                <a href="?add_to_cart=<?= urlencode($product['name']) ?>" class="text-[#f97316]">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
            <button class="bg-[#f97316] text-white text-[10px] font-extrabold rounded-full px-4 py-1 w-full hover:bg-[#e25816] transition">
                Buy now!
            </button>
        </article>
    <?php endforeach; ?>
</main>

</body>
</html>