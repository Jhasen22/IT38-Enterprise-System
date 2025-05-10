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
    <title>HardwareHub - Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-slate-200 to-slate-300 min-h-screen">
    <header class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center space-x-2">
            <img src="https://storage.googleapis.com/a1aa/image/1f328757-ef12-4796-60c3-2828c96fe4af.jpg" alt="HardwareHub logo" class="w-10 h-10" width="40" height="40" />
            <span class="font-extrabold text-slate-900 text-sm select-none">HardwareHub</span>
        </div>
        <nav class="flex space-x-8 text-slate-900 font-semibold text-sm">
            <a class="hover:underline" href="index.php">Home</a>
            <a class="border-b-2 border-slate-400 pb-1" href="products.php">Products</a>
            <a class="hover:underline" href="about.php">About us</a>
            <a class="hover:underline" href="contacts.php">Contacts</a>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center md:items-start gap-10 md:gap-20">
        <section class="max-w-xl flex flex-col space-y-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
                <span>Explore Our</span><br />
                <span class="font-normal">Wide Range of Products</span>
            </h1>
            <p class="text-slate-900 text-sm">
                Browse our selection of high-quality tools designed to meet every builder's needs.
            </p>
        </section>
        <section class="flex-shrink-0">
            <img src="https://storage.googleapis.com/a1aa/image/42b8f806-6be2-477a-c165-4fa7df65354c.jpg" alt="Various hand tools" class="w-[300px] h-[200px] object-contain" width="300" height="200" />
        </section>
    </main>
</body>

</html>
