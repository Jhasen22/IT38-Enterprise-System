<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>HardwareHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>body{font-family:"Inter",sans-serif;}</style>
</head>
<body class="bg-gradient-to-br from-[#dbe4ee] to-[#e6ecf4] min-h-screen flex flex-col">
  <header class="flex justify-between items-center px-6 md:px-12 py-6 max-w-7xl mx-auto w-full">
    <div class="flex items-center space-x-3">
      <img alt="HardwareHub logo with blue background and white hardware icon" class="w-10 h-10 rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/86ababd2-f2cb-461c-68d1-06d35700df6f.jpg" width="40"/>
      <span class="font-extrabold text-sm text-[#1f2937] select-none">HardwareHub</span>
    </div>
    <nav class="hidden md:flex space-x-12 font-semibold text-[#1f2937] text-sm">
      <a class="underline decoration-2 decoration-[#1f2937] font-extrabold" href="home.php">Home</a>
      <a class="hover:underline" href="products.php">Products</a>
      <a class="hover:underline" href="about.php">About us</a>
      <a class="hover:underline" href="#">Contacts</a>
    </nav>
  </header>
  <main class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-6 md:px-12 flex-grow">
    <section class="max-w-xl md:max-w-lg lg:max-w-xl">
      <h1 class="text-3xl md:text-4xl font-extrabold text-[#1f2937] leading-tight mb-4">
        <span>Tools you trust,</span>
        <span class="font-normal">service you deserve.</span>
      </h1>
      <p class="text-xs md:text-sm font-extrabold text-[#0f2a5a] mb-8">Explore Our high-quality products designed for every builder\'s needs.</p>
      <a href="products.php" class="bg-[#f97316] text-white text-xs font-extrabold px-5 py-2 rounded-md hover:bg-[#ea6f0b] transition">Browse Our Best Deals</a>
    </section>
    <section class="mt-12 md:mt-0">
      <img alt="Set of tools with red and black handles and silver metal parts arranged fan-like" class="w-[400px] max-w-full h-auto" height="250" src="https://storage.googleapis.com/a1aa/image/81dbd2e2-c411-4703-93a3-6587b65320cd.jpg" width="400"/>
    </section>
  </main>
</body>
</html>';
?>