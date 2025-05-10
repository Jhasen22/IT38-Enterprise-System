<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Sample checkout cart (normally fetched from session or DB)
$cart = [
    [
        'name' => 'Stanley Adjustable Wrench Set',
        'price' => 142.00,
        'quantity' => 2,
        'image' => 'https://storage.googleapis.com/a1aa/image/e3e06543-63d9-4719-6ab3-39350751ad9b.jpg'
    ],
    [
        'name' => 'Black & Decker Electric Drill',
        'price' => 542.00,
        'quantity' => 1,
        'image' => 'https://storage.googleapis.com/a1aa/image/76e95a5a-8a7a-49df-aa05-e035c1cd6ae9.jpg'
    ],
    [
        'name' => 'Castile Claw Hammer',
        'price' => 242.00,
        'quantity' => 2,
        'image' => 'https://storage.googleapis.com/a1aa/image/0faf407a-7850-4445-81af-9a7c78f538ef.jpg'
    ]
];

// Calculate subtotal
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Checkout - HardwareHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-[#dbe3eb] to-[#f0f4f8] min-h-screen p-6">

  <!-- Header Section -->
  <header class="flex items-center justify-between max-w-7xl mx-auto mb-8">
    <div class="flex items-center space-x-3">
      <img src="https://storage.googleapis.com/a1aa/image/84f5050a-31e1-4109-1e3d-1ff777c94f8d.jpg" class="w-10 h-10" alt="HardwareHub logo"/>
      <span class="font-extrabold text-sm text-[#1f2937] select-none">HardwareHub</span>
    </div>
    <nav class="hidden md:flex space-x-10 font-extrabold text-sm text-[#1f2937]">
      <a class="hover:underline" href="index.php">Home</a>
      <a class="hover:underline" href="products.php">Products</a>
      <a class="hover:underline" href="about.php">About us</a>
      <a class="hover:underline" href="contacts.php">Contacts</a>
    </nav>
    <button aria-label="Shopping cart" class="text-[#f97316] text-xl">
      <i class="fas fa-shopping-cart"></i>
    </button>
  </header>

  <!-- Main Checkout Section -->
  <main class="max-w-7xl mx-auto bg-white rounded-lg p-8 shadow-sm">
    <h1 class="font-extrabold text-lg text-[#111827] mb-6 select-none">Check Out</h1>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
      <!-- Products List -->
      <div class="md:col-span-8 space-y-8">
        <?php foreach ($cart as $item): ?>
        <div class="flex items-center space-x-6">
          <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-20 h-15 rounded-md bg-gray-200"/>
          <div class="flex-1">
            <p class="font-extrabold text-xs text-[#111827] leading-tight select-none"><?= htmlspecialchars($item['name']) ?></p>
          </div>
          <div class="w-20 text-xs font-extrabold text-[#111827] select-none">
            $<?= number_format($item['price'], 2) ?>
          </div>
          <div class="flex items-center space-x-1 border border-gray-300 rounded text-xs px-1 py-0.5 select-none">
            <button class="border border-gray-300 rounded px-1">-</button>
            <span class="w-5 text-center"><?= $item['quantity'] ?></span>
            <button class="border border-gray-300 rounded px-1">+</button>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Shipping and Payment Section -->
      <div class="md:col-span-4 space-y-6">
        <form class="space-y-3">
          <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-[#6b7280] placeholder-[#6b7280] focus:outline-none focus:ring-1 focus:ring-blue-600" placeholder="Name" type="text" required />
          <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-[#6b7280] placeholder-[#6b7280] focus:outline-none focus:ring-1 focus:ring-blue-600" placeholder="Address" type="text" required />
          <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-[#6b7280] placeholder-[#6b7280] focus:outline-none focus:ring-1 focus:ring-blue-600" placeholder="Phone" type="text" required />
        </form>

        <div>
          <p class="font-extrabold text-xs text-[#111827] mb-2 select-none">Payment</p>
          <form class="space-y-2 text-xs text-[#111827] select-none">
            <label class="flex items-center space-x-2">
              <input type="radio" name="payment" value="cash" checked class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
              <span>Cash on delivery</span>
            </label>
            <label class="flex items-center space-x-2">
              <input type="radio" name="payment" value="gcash" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
              <span>G cash</span>
            </label>
            <label class="flex items-center space-x-2">
              <input type="radio" name="payment" value="paypal" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" />
              <span>Paypal</span>
            </label>
          </form>
        </div>

        <div class="flex justify-between items-center text-xs font-extrabold text-[#111827] select-none">
          <span>Subtotal</span>
          <span>$<?= number_format($subtotal, 2) ?></span>
        </div>

        <button class="bg-blue-700 text-white text-xs font-extrabold rounded px-4 py-2 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 w-full">
          Place Order
        </button>
      </div>
    </div>
  </main>
</body>
</html>
