<?php
  echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Contact HardwareHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>body{font-family:"Inter",sans-serif;}</style>
</head>
<body class="bg-gradient-to-br from-[#d9e1e9] to-[#a7b6c9] min-h-screen flex flex-col">
  <header class="flex items-center justify-between px-6 py-5 max-w-7xl mx-auto">
    <div class="flex items-center space-x-3">
      <img alt="HardwareHub logo with gear and wrench icon in blue and red colors" class="w-10 h-10" height="40" src="https://storage.googleapis.com/a1aa/image/47b9e434-501d-4ce8-69c0-b5c41c7b766f.jpg" width="40"/>
      <span class="font-extrabold text-[14px] text-[#1f2a3d] select-none">HardwareHub</span>
    </div>
    <nav class="hidden md:flex space-x-14 font-semibold text-[14px] text-[#1f2a3d]">
      <a class="hover:underline" href="#">Home</a>
      <a class="hover:underline" href="#">Products</a>
      <a class="hover:underline" href="#">About us</a>
      <a class="underline decoration-[#6b7f9e] decoration-2 underline-offset-4 font-bold cursor-default" href="#">Contacts</a>
    </nav>
  </header>
  <main class="flex-grow flex items-center justify-center px-4 pb-12">
    <section class="max-w-5xl w-full rounded-xl overflow-hidden flex flex-col md:flex-row bg-[#d9dfe4]" style="box-shadow: inset -40px 0 60px -20px #1f2a3d, inset 40px 0 60px -20px #6b7f9e;">
      <div class="flex flex-col bg-gradient-to-b from-[#1f2a3d] to-[#6b7f9e] p-8 md:w-1/3 space-y-6 rounded-t-xl md:rounded-tr-none md:rounded-l-xl text-white">
        <h2 class="font-extrabold text-[16px]">Contact Information</h2>
        <p class="text-[11px] leading-tight max-w-[220px]">Fill up the form and we will get back to you within 24 hours</p>
        <div class="flex flex-col space-y-5 text-[10px]">
          <div class="flex items-center space-x-3">
            <div class="bg-white text-[#1f2a3d] rounded-full w-7 h-7 flex items-center justify-center">
              <i class="fas fa-phone-alt text-[10px]"></i>
            </div>
            <span>Phone : 09357484257</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="bg-white text-[#1f2a3d] rounded-full w-7 h-7 flex items-center justify-center">
              <i class="fab fa-telegram-plane text-[10px]"></i>
            </div>
            <span>Email : HardWareHub@gmail.com</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="bg-white text-[#1f2a3d] rounded-full w-7 h-7 flex items-center justify-center">
              <i class="fab fa-facebook-f text-[10px]"></i>
            </div>
            <span>Facebook : HardWareHub</span>
          </div>
        </div>
      </div>
      <form class="flex flex-col p-8 md:w-2/3 space-y-6" method="post" action="contact_process.php">
        <h2 class="font-extrabold text-[16px] text-[#1f2a3d]">Send Us Message</h2>
        <div class="flex space-x-6">
          <input class="bg-[#1f2a3d] text-white text-[12px] rounded-lg py-2 px-4 w-1/2 placeholder:text-[#6b7f9e] focus:outline-none" placeholder="Full Name" type="text" name="full_name" required />
          <input class="bg-[#1f2a3d] text-white text-[12px] rounded-lg py-2 px-4 w-1/2 placeholder:text-[#6b7f9e] focus:outline-none" placeholder="Phone" type="tel" name="phone" required />
        </div>
        <textarea class="bg-[#1f2a3d] text-white text-[12px] rounded-lg py-3 px-4 resize-none placeholder:text-[#6b7f9e] focus:outline-none" placeholder="Write your message" rows="5" name="message" required></textarea>
        <button class="bg-[#1f2a3d] text-white font-semibold text-[12px] rounded-full py-2 w-40 self-center hover:bg-[#162134] transition-colors" type="submit">Send Message</button>
      </form>
    </section>
  </main>
</body>
</html>';
?>
