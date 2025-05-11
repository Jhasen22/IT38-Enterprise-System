<?php
session_start();

// Check if order details exist
if (!isset($_SESSION['order_details'])) {
    header('Location: products.php');
    exit();
}

// Get order details
$order = $_SESSION['order_details'];

// Simulate order status (in a real app, this would come from database)
$status = [
    'ordered' => ['completed' => true, 'date' => date('Y-m-d')],
    'processed' => ['completed' => true, 'date' => date('Y-m-d', strtotime('+1 day'))],
    'shipped' => ['completed' => true, 'date' => date('Y-m-d', strtotime('+2 days'))],
    'delivered' => ['completed' => false, 'date' => date('Y-m-d', strtotime('+4 days'))]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Track Your Order</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
    .tracking-step {
      @apply relative pb-8;
    }
    .tracking-step:not(:last-child):before {
      @apply content-[''] absolute left-[18px] top-[30px] h-full w-0.5 bg-gray-300;
    }
    .tracking-step.active .step-icon {
      @apply bg-blue-600 text-white;
    }
    .tracking-step.completed .step-icon {
      @apply bg-green-500 text-white;
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-[#e2e8f0] via-[#f1f5f9] to-[#e2e8f0] min-h-screen flex items-center justify-center p-4">
  <div class="max-w-md w-full bg-white rounded-md p-6 drop-shadow-md">
    <div class="flex flex-col items-center mb-6">
      <img alt="HardwareHub logo, circular with blue and red hardware tool icons" class="mb-2" height="40" src="https://storage.googleapis.com/a1aa/image/a1a88a64-427e-4002-f4f5-2a5ec7d3a1a0.jpg" width="40"/>
      <p class="text-center font-extrabold text-sm leading-tight">Order Tracking</p>
    </div>
    
    <div class="bg-white rounded-md p-4 drop-shadow-sm border border-gray-200 mb-6">
      <div class="flex items-center justify-between mb-4">
        <div>
          <p class="text-xs text-gray-500">Order Number</p>
          <p class="font-bold text-sm"><?= htmlspecialchars($order['order_number']) ?></p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Estimated Delivery</p>
          <p class="font-bold text-sm"><?= date('M j, Y', strtotime('+4 days')) ?></p>
        </div>
      </div>
      
      <div class="space-y-1">
        <?php foreach ($status as $step => $details): ?>
          <div class="tracking-step <?= $details['completed'] ? 'completed' : 'active' ?>">
            <div class="flex items-start">
              <div class="step-icon flex items-center justify-center w-9 h-9 rounded-full bg-gray-200 text-gray-600 flex-shrink-0">
                <?php if ($step === 'ordered'): ?>
                  <i class="fas fa-shopping-cart text-xs"></i>
                <?php elseif ($step === 'processed'): ?>
                  <i class="fas fa-cog text-xs"></i>
                <?php elseif ($step === 'shipped'): ?>
                  <i class="fas fa-truck text-xs"></i>
                <?php else: ?>
                  <i class="fas fa-check text-xs"></i>
                <?php endif; ?>
              </div>
              <div class="ml-4">
                <p class="text-xs font-bold text-gray-800 capitalize"><?= $step ?></p>
                <p class="text-xs text-gray-500"><?= $details['date'] ?></p>
                <?php if ($step === 'shipped' && $details['completed']): ?>
                  <p class="text-xs text-gray-500 mt-1">Shipped via Fast Delivery</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="bg-white rounded-md p-4 drop-shadow-sm border border-gray-200">
      <div class="flex flex-col sm:flex-row sm:space-x-6">
        <div class="flex space-x-4 flex-1">
          <div class="flex flex-col text-xs text-gray-600 w-24">
            <img alt="<?= htmlspecialchars($order['items'][0]['name']) ?>" class="mb-2" height="64" src="<?= htmlspecialchars($order['items'][0]['image']) ?>" width="64"/>
          </div>
          <div class="flex flex-col text-xs text-gray-700 flex-1">
            <?php foreach ($order['items'] as $item): ?>
              <span class="font-bold text-[11px] mb-1"><?= htmlspecialchars($item['name']) ?></span>
              <span class="mb-1"><?= $item['quantity'] ?> x $<?= number_format($item['price'], 2) ?></span>
            <?php endforeach; ?>
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
      <div class="border-t border-gray-300 mt-4 pt-3 flex justify-center">
        <a href="products.php" class="border border-gray-900 text-gray-900 text-xs font-semibold rounded px-4 py-2 w-full sm:w-auto hover:bg-gray-100 transition text-center">
          Continue Shopping
        </a>
      </div>
    </div>
  </div>
</body>
</html>