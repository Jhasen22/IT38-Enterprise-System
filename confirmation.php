<?php
session_start();

// Check if order details exist
if (!isset($_SESSION['order_details'])) {
    header('Location: products.php');
    exit();
}

// Get order details
$order = $_SESSION['order_details'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Order Confirmation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-[#e2e8f0] via-[#f1f5f9] to-[#e2e8f0] min-h-screen flex items-center justify-center p-4">
  <div class="max-w-md w-full bg-white rounded-md p-6 drop-shadow-md">
    <div class="flex flex-col items-center mb-6">
      <img alt="HardwareHub logo, circular with blue and red hardware tool icons" class="mb-2" height="40" src="https://storage.googleapis.com/a1aa/image/a1a88a64-427e-4002-f4f5-2a5ec7d3a1a0.jpg" width="40"/>
      <p class="text-center font-extrabold text-sm leading-tight">HardwareHub</p>
    </div>
    <div class="flex flex-col items-center mb-6">
      <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center mb-2">
        <i class="fas fa-check text-white text-lg"></i>
      </div>
      <p class="font-extrabold text-center text-sm leading-tight">Thank you!<br/>Your order has been placed.</p>
    </div>
    <div class="bg-white rounded-md p-4 drop-shadow-sm border border-gray-200">
      <div class="flex flex-col sm:flex-row sm:space-x-6">
        <div class="flex space-x-4 flex-1">
          <div class="flex flex-col text-xs text-gray-600 w-24">
            <span class="font-bold mb-2">Order#<?= htmlspecialchars($order['order_number']) ?></span>
            <?php if (count($order['items']) > 0): ?>
              <img alt="<?= htmlspecialchars($order['items'][0]['name']) ?>" class="mb-2" height="64" src="<?= htmlspecialchars($order['items'][0]['image']) ?>" width="64"/>
            <?php endif; ?>
          </div>
          <div class="flex flex-col text-xs text-gray-700 flex-1">
            <?php foreach ($order['items'] as $item): ?>
              <span class="font-bold text-[11px] mb-1"><?= htmlspecialchars($item['name']) ?></span>
              <span class="mb-1"><?= $item['quantity'] ?> x $<?= number_format($item['price'], 2) ?></span>
            <?php endforeach; ?>
            <span class="text-[9px] text-gray-500">Payment Method: <?= htmlspecialchars($order['payment_method']) ?></span>
          </div>
        </div>
        <div class="border-l border-gray-300 pl-4 mt-4 sm:mt-0 text-[10px] text-gray-600 w-36">
          <p class="font-bold mb-1">Shipping to</p>
          <p>
            <?= htmlspecialchars($order['name']) ?><br/>
            <?= nl2br(htmlspecialchars($order['address'])) ?>
          </p>
        </div>
      </div>
      <div class="border-t border-gray-300 mt-4 pt-3 flex flex-col sm:flex-row sm:items-center sm:justify-between text-xs font-bold text-gray-900">
        <div class="mb-3 sm:mb-0 flex justify-between w-full sm:w-auto">
          <span>Total</span>
          <span>$<?= number_format($order['total'], 2) ?></span>
        </div>
        <div class="flex space-x-3 w-full sm:w-auto">
          <a href="products.php" class="border border-gray-900 text-gray-900 text-xs font-semibold rounded px-4 py-2 w-full sm:w-auto hover:bg-gray-100 transition text-center">
            Continue Shopping
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
// Clear order details after displaying them
unset($_SESSION['order_details']);
?>