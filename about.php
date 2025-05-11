<?php
  $company_name = "HardwareHub";
  $company_description = "HardwareHub is an e-commerce platform dedicated to offering high-quality hand tools. Our platform makes it easy to browse and purchase essential tools without the hassle of going to physical stores. HardwareHub aims to be the go-to place for all your hand tool needs, delivering a seamless online shopping experience.";
  $mission = "Our mission is to become the go-to destination for all your hardware needs. We aim to revolutionize the industry with an easy-to-navigate platform, competitive prices, and an unmatched product selection.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title><?php echo $company_name; ?> About Us</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-[#dbe3eb] to-[#f0f4f9] min-h-screen">
  <header class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
    <div class="flex items-center space-x-3">
      <img alt="HardwareHub logo with a blue and red gear and wrench icon" class="w-10 h-10" height="40" src="https://storage.googleapis.com/a1aa/image/fc52e0a3-f5b0-44c3-1bd8-f72a752eefb1.jpg" width="40"/>
      <span class="font-extrabold text-sm select-none">
        <?php echo $company_name; ?>
      </span>
    </div>
    <nav class="hidden md:flex space-x-12 font-semibold text-sm text-black">
      <a class="hover:underline" href="home.php">Home</a>
      <a class="hover:underline" href="products.php">Products</a>
      <a class="underline decoration-[1.5px] decoration-gray-600 decoration-solid underline-offset-2" href="about.php">About us</a>
      <a class="hover:underline" href="#">Contacts</a>
    </nav>
  </header>

  <main class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-center gap-10 md:gap-20 min-h-[calc(100vh-96px)]">
    <div class="flex-1 max-w-xl text-center md:text-left">
      <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-6">
        <span>Quality Tools</span>
        <span class="font-normal">, Right at</span><br/>
        <span class="font-normal">Your Fingertips</span>
      </h1>
      <section class="text-sm text-[#0f2f67] space-y-6">
        <div>
          <h2 class="font-extrabold mb-1">About us</h2>
          <p><?php echo $company_description; ?></p>
        </div>
        <div>
          <h2 class="font-extrabold mb-1">Our Mission</h2>
          <p><?php echo $mission; ?></p>
        </div>
      </section>
    </div>
    <div class="flex-1 flex justify-center md:justify-center">
      <img alt="A collection of hand tools including hammer, pliers, screwdriver, wrench, and drill arranged horizontally" class="max-w-full h-auto" height="200" src="https://storage.googleapis.com/a1aa/image/4656df5d-570d-4b08-70d7-c3e12e515c62.jpg" width="400"/>
    </div>
  </main>
</body>
</html>