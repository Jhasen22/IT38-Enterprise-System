<?php
// Sample cart items (you can later load this from a database or session)
$cart = [
    [
        "name" => "Stanley Adjustable Wrench Set",
        "price" => 142.00,
        "quantity" => 2,
        "image" => "https://storage.googleapis.com/a1aa/image/8b81d386-8659-4f55-2cb0-a7bdb5a78252.jpg",
    ],
    [
        "name" => "Black & Decker Electric Drill",
        "price" => 542.00,
        "quantity" => 1,
        "image" => "https://storage.googleapis.com/a1aa/image/37294978-9d33-401b-4d38-b8553981a9d8.jpg",
    ],
    [
        "name" => "Castile Claw Hammer",
        "price" => 242.00,
        "quantity" => 2,
        "image" => "https://storage.googleapis.com/a1aa/image/c40581a6-bd36-41ea-a623-4f3d52c81cc3.jpg",
    ],
];

$subtotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping Cart</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap");
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-[#e6ebf1] min-h-screen">
  <header class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
    <div class="flex items-center space-x-3">
      <img src="https://storage.googleapis.com/a1aa/image/17d88d51-4e71-4f95-650b-573a2b82c415.jpg" alt="HardwareHub logo" class="w-10 h-10 rounded-full"/>
      <span class="font-bold text-sm text-[#1a1a1a] select-none">HardwareHub</span>
    </div>
    <nav class="hidden md:flex space-x-10 font-bold text-sm text-[#1a1a1a]">
      <a href="#" class="hover:underline">Home</a>
      <a href="#" class="hover:underline">Products</a>
      <a href="#" class="hover:underline">About us</a>
      <a href="#" class="hover:underline">Contacts</a>
    </nav>
    <button aria-label="Shopping cart" class="text-[#f97316] text-xl md:text-2xl">
      <i class="fas fa-shopping-cart"></i>
    </button>
  </header>

  <main class="max-w-5xl mx-auto px-6 pb-12">
    <h1 class="font-extrabold text-[#1a1a1a] text-lg mb-6 select-none">Shopping Cart</h1>

    <section class="bg-white rounded-lg p-6 shadow-sm border border-transparent border-b-[#d1d5db] border-b-[1px]">
      <div class="grid grid-cols-12 gap-4 border-b border-[#d1d5db] pb-3 mb-3 text-xs font-bold text-[#1a1a1a]">
        <div class="col-span-6">Products</div>
        <div class="col-span-2 text-center">Price</div>
        <div class="col-span-2 text-center">Quantity</div>
        <div class="col-span-2 text-right">Total</div>
      </div>

      <?php foreach ($cart as $item): 
        $item_total = $item['price'] * $item['quantity'];
        $subtotal += $item_total;
      ?>
      <div class="grid grid-cols-12 gap-4 items-center border-b border-[#d1d5db] py-3 text-[10px] font-semibold text-[#1a1a1a]">
        <div class="col-span-6 flex items-center space-x-4">
          <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-14 h-14 rounded-md bg-[#e5e7eb]"/>
          <span class="select-none"><?= htmlspecialchars($item['name']) ?></span>
        </div>
        <div class="col-span-2 text-center select-none">$<?= number_format($item['price'], 2) ?></div>
        <div class="col-span-2 flex justify-center items-center space-x-1">
          <button class="border border-[#d1d5db] w-6 h-6 text-xs font-semibold text-[#1a1a1a] rounded-sm">−</button>
          <span class="w-6 h-6 flex justify-center items-center border border-[#d1d5db] rounded-sm"><?= $item['quantity'] ?></span>
          <button class="border border-[#d1d5db] w-6 h-6 text-xs font-semibold text-[#1a1a1a] rounded-sm">+</button>
        </div>
        <div class="col-span-2 text-right select-none">$<?= number_format($item_total, 2) ?></div>
      </div>
      <?php endforeach; ?>

      <div class="flex justify-end items-center mt-6 border-t border-[#d1d5db] pt-4 text-[10px] font-bold text-[#1a1a1a]">
        <span class="mr-6 select-none">Subtotal</span>
        <span class="select-none w-20 text-right"><?= number_format($subtotal, 2) ?></span>
      </div>

      <div class="flex justify-end mt-4">
        <button class="bg-[#0052cc] text-white text-xs font-bold px-6 py-2 rounded select-none hover:bg-[#003d99] transition-colors">Checkout</button>
      </div>
    </section>
  </main>
</body>
</html>
