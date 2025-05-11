<?php
session_start();

// Check if cart exists and has items
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Payment methods
$payment_methods = ['Cash on delivery', 'G cash', 'Paypal'];

// Calculate subtotal
$subtotal = array_reduce($_SESSION['cart'], function($total, $item) {
    return $total + ($item['price'] * $item['quantity']);
}, 0);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store order details in session
    $_SESSION['order_details'] = [
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'payment_method' => $_POST['payment'],
        'items' => $_SESSION['cart'],
        'total' => $subtotal,
        'order_number' => 'ORD-' . strtoupper(uniqid())
    ];
    
    // Clear the cart
    unset($_SESSION['cart']);
    
    // Redirect to confirmation page
    header('Location: confirmation.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>HardwareHub Checkout</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .form-input {
      @apply w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all;
    }
    .form-label {
      @apply block text-sm font-bold text-gray-700 mb-2;
    }
    .form-section {
      @apply bg-white p-6 rounded-xl shadow-md border border-gray-100;
    }
  </style>
</head>
<body class="bg-[#f5f7fa] min-h-screen">
  <header class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
    <div class="flex items-center space-x-2">
      <img alt="HardwareHub logo with blue and red gear icon" class="w-8 h-8 rounded-full" height="32" src="https://storage.googleapis.com/a1aa/image/a1a88a64-427e-4002-f4f5-2a5ec7d3a1a0.jpg" width="32"/>
      <span class="font-extrabold text-[13px] leading-[16px] text-black select-none">
        HardwareHub
      </span>
    </div>
    <nav class="hidden md:flex space-x-10 font-extrabold text-[13px] leading-[16px] text-black select-none">
      <a class="hover:underline" href="home.php">Home</a>
      <a class="hover:underline" href="products.php">Products</a>
      <a class="hover:underline" href="about.php">About us</a>
      <a class="hover:underline" href="#">Contacts</a>
    </nav>
    <a href="cart.php" class="text-[#f97316] text-lg relative">
      <i class="fas fa-shopping-cart"></i>
      <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
          <?php echo array_reduce($_SESSION['cart'], function($carry, $item) { return $carry + $item['quantity']; }, 0); ?>
        </span>
      <?php endif; ?>
    </a>
  </header>

  <main class="max-w-7xl mx-auto px-6 pb-12">
    <h2 class="font-extrabold text-2xl text-gray-800 mb-6 select-none">
      Check Out
    </h2>
    <form method="post" action="checkout.php">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Shipping Address -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Shipping Address Section -->
          <section class="form-section">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Shipping Address</h3>
            <div class="space-y-4">
              <div>
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Jhasen Ambogna" required>
              </div>
              
              <div>
                <label for="address" class="form-label">Complete Address</label>
                <textarea id="address" name="address" rows="4" class="form-input" placeholder="Street, City, State, ZIP Code" required></textarea>
              </div>
              
              <div>
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-input" placeholder="+639" required>
              </div>
            </div>
          </section>

          <!-- Order Summary Section -->
          <section class="form-section">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Your Order</h3>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead>
                  <tr class="border-b border-gray-200">
                    <th class="text-left py-3 font-bold text-gray-700">Product</th>
                    <th class="text-right py-3 font-bold text-gray-700">Price</th>
                    <th class="text-right py-3 font-bold text-gray-700">Qty</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($_SESSION['cart'] as $product): ?>
                    <tr class="border-b border-gray-100">
                      <td class="py-4">
                        <div class="flex items-center space-x-4">
                          <img alt="<?= htmlspecialchars($product['name']) ?>" class="w-12 h-12 rounded-lg bg-gray-100" src="<?= htmlspecialchars($product['image']) ?>"/>
                          <span class="font-medium text-gray-800"><?= htmlspecialchars($product['name']) ?></span>
                        </div>
                      </td>
                      <td class="text-right py-4 font-medium text-gray-800">$<?= number_format($product['price'], 2) ?></td>
                      <td class="text-right py-4 font-medium text-gray-800"><?= $product['quantity'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </section>
        </div>

        <!-- Right Column - Payment and Order Summary -->
        <div class="space-y-6">
          <!-- Payment Method Section -->
          <section class="form-section">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Payment Method</h3>
            <div class="space-y-4">
              <?php foreach ($payment_methods as $method): ?>
                <label class="flex items-center space-x-3 p-3 border-2 border-gray-200 rounded-lg hover:border-blue-400 transition-all cursor-pointer">
                  <input class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" name="payment" type="radio" value="<?= htmlspecialchars($method) ?>" required/>
                  <span class="font-medium text-gray-800"><?= htmlspecialchars($method) ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- Order Total Section -->
          <section class="form-section">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Order Summary</h3>
            <div class="space-y-3">
              <div class="flex justify-between">
                <span class="text-gray-600">Subtotal:</span>
                <span class="font-medium">$<?= number_format($subtotal, 2) ?></span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Shipping:</span>
                <span class="font-medium">Free</span>
              </div>
              <div class="border-t border-gray-200 pt-3 mt-3">
                <div class="flex justify-between font-bold text-lg">
                  <span>Total:</span>
                  <span>$<?= number_format($subtotal, 2) ?></span>
                </div>
              </div>
            </div>
            <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors">
              Place Order
            </button>
          </section>
        </div>
      </div>
    </form>
  </main>
</body>
</html>