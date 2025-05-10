<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>HardwareHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-[#1a1a1a] min-h-screen flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-[#e3ebf5] to-[#f0f4f9] max-w-6xl w-full rounded-md p-8 md:p-16 relative">
        <header class="flex justify-between items-center mb-12">
            <div class="flex items-center gap-3">
                <img alt="HardwareHub logo with a blue and red circular icon showing tools" class="w-10 h-10" height="40"
                    src="https://storage.googleapis.com/a1aa/image/daf48b8e-3b95-486b-0e2e-6f446a8c6059.jpg" width="40" />
                <span class="font-semibold text-[14px] text-[#1a1a1a] select-none">
                    HardwareHub
                </span>
            </div>
            <nav class="flex gap-12 font-semibold text-[14px] text-[#1a1a1a]">
                <a class="underline decoration-2 decoration-[#1a1a1a]" href="#">
                    Home
                </a>
                <a href="products.php">
                    Products
                </a>
                <a href="#">
                    About us
                </a>
                <a href="#">
                    Contacts
                </a>
            </nav>
        </header>
        <div class="flex flex-col md:flex-row items-center md:items-start w-full gap-8 justify-center">
            <div class="max-w-xl flex flex-col gap-6 text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#1a1a1a] leading-snug">
                    <span class="font-extrabold">
                        Tools you trust,
                    </span>
                    service you deserve.
                </h1>
                <p class="text-[13px] md:text-sm font-semibold text-[#0f2f6f]">
                    Explore our high-quality products designed for every builder’s needs.
                </p>
                <a href="products.php">
                    <button class="bg-[#f97316] text-white text-[13px] font-semibold rounded px-4 py-2 w-max mx-auto md:mx-0 shadow-md hover:shadow-lg transition-shadow"
                        type="button">
                        Browse Our Best Deals
                    </button>
                </a>
            </div>
            <div class="flex-shrink-0">
                <img alt="Set of tools including hammer, wrenches, pliers with red and black handles"
                    class="max-w-full h-auto" height="250"
                    src="https://storage.googleapis.com/a1aa/image/56792284-60b9-420e-eeed-07233e54df78.jpg" width="400" />
            </div>
        </div>
    </div>
</body>

</html>
