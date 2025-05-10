<?php
  // Example products
  $products = [
    [
      "name" => "Stanley Adjustable Wrench Set",
      "image" => "https://storage.googleapis.com/a1aa/image/5e32720e-4791-4c1e-158d-53c41fe0bbc6.jpg",
      "price" => 142.00,
      "quantity" => 2,
    ],
    [
      "name" => "Black & Decker Electric Drill",
      "image" => "https://storage.googleapis.com/a1aa/image/b60002c6-aa14-44b9-e911-ee72ee2ebc68.jpg",
      "price" => 542.00,
      "quantity" => 1,
    ],
    [
      "name" => "Castile Claw Hammer",
      "image" => "https://storage.googleapis.com/a1aa/image/d55264ca-1934-4386-7720-809a7e283628.jpg",
      "price" => 242.00,
      "quantity" => 2,
    ],
  ];

  $subtotal = 0;
  foreach ($products as $product) {
    $subtotal += $product['price'] * $product['quantity'];
  }

  // Payment methods (This can be dynamic if needed)
  $payment_methods = ['Cash on delivery', 'G cash', 'Paypal'];
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
  </style>
</head>
<body class="bg-[#dbe3eb] min-h-screen">
  <header class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
    <div class="flex items-center space-x-2">
      <img alt="HardwareHub logo with blue and red gear icon" class="w-8 h-8 rounded-full" height="32" src="https://storage.googleapis.com/a1aa/image/a1a88a64-427e-4002-f4f5-2a5ec7d3a1a0.jpg" width="32"/>
      <span class="font-extrabold text-[13px] leading-[16px] text-black select-none">
        HardwareHub
      </span>
    </div>
    <nav class="hidden md:flex space-x-10 font-extrabold text-[13px] leading-[16px] text-black select-none">
      <a class="hover:underline" href="#">Home</a>
      <a class="hover:underline" href="#">Products</a>
      <a class="hover:underline" href="#">About us</a>
      <a class="hover:underline" href="#">Contacts</a>
    </nav>
    <div>
      <button aria-label="Shopping cart" class="text-[#f97316] text-lg">
        <i class="fas fa-shopping-cart"></i>
      </button>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 pb-12">
    <h2 class="font-extrabold text-[14px] leading-[18px] text-black mb-4 select-none">
      Check Out
    </h2>
    <section aria-label="Checkout form and order summary" class="bg-white rounded-lg p-5 md:p-7 shadow-sm max-w-full overflow-x-auto">
      <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr_1fr_2fr] gap-x-5 gap-y-5 md:gap-y-6 text-[11px] leading-[14px] text-black font-extrabold select-none">
        <div class="hidden md:block">Products</div>
        <div class="hidden md:block">Price</div>
        <div class="hidden md:block">Quantity</div>
        <div class="hidden md:block">Shipping Address</div>

        <?php foreach ($products as $product): ?>
          <div class="flex items-center space-x-3 md:space-x-5">
            <img alt="<?php echo $product['name']; ?>" class="w-12 h-12 rounded-lg bg-[#e6e6e6] flex-shrink-0" height="48" src="<?php echo $product['image']; ?>" width="48"/>
            <div class="text-[8px] leading-[10px] font-extrabold text-black max-w-[80px] md:max-w-none">
              <?php echo $product['name']; ?>
            </div>
          </div>
          <div class="flex items-center font-extrabold text-[11px] leading-[14px] text-black">
            $<?php echo number_format($product['price'], 2); ?>
          </div>
          <div class="flex items-center space-x-1">
            <button aria-label="Decrease quantity of <?php echo $product['name']; ?>" class="w-5 h-5 border border-gray-300 rounded text-[11px] font-extrabold text-black flex items-center justify-center select-none">-</button>
            <span class="w-5 h-5 border border-gray-300 rounded text-[11px] font-extrabold text-black flex items-center justify-center select-none"><?php echo $product['quantity']; ?></span>
            <button aria-label="Increase quantity of <?php echo $product['name']; ?>" class="w-5 h-5 border border-gray-300 rounded text-[11px] font-extrabold text-black flex items-center justify-center select-none">+</button>
          </div>
          <div>
          </div>
        <?php endforeach; ?>

        <div class="col-span-1 md:col-span-3">
        </div>
        <div class="col-span-1 md:col-span-1 flex flex-col justify-start">
          <div class="font-extrabold text-[11px] leading-[14px] text-black mb-2 select-none">
            Payment
          </div>
          <form class="space-y-1 text-[11px] leading-[14px] font-extrabold text-black">
            <?php foreach ($payment_methods as $method): ?>
              <label class="flex items-center space-x-2 cursor-pointer">
                <input class="w-4 h-4 text-[#2563eb] border-gray-300 focus:ring-[#2563eb]" name="payment" type="radio" value="<?php echo strtolower(str_replace(' ', '', $method)); ?>"/>
                <span><?php echo $method; ?></span>
              </label>
            <?php endforeach; ?>
          </form>

          <div class="flex justify-between items-center mt-4">
            <span class="font-extrabold text-[11px] leading-[14px] text-black select-none">
              Subtotal
            </span>
            <span class="font-extrabold text-[11px] leading-[14px] text-black select-none">
              $<?php echo number_format($subtotal, 2); ?>
            </span>
          </div>
          <button class="mt-3 bg-[#0047ff] text-white text-[11px] leading-[14px] font-extrabold rounded px-3 py-1.5 hover:bg-[#0036cc] transition-colors" type="button">
            Place Order
          </button>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
