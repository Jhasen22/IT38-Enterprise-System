<?php
session_start();

// Connect to your database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hardwarehub';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if email exists
  $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    // Verify hashed password
    if (password_verify($password, $hashed_password)) {
      $_SESSION['user'] = $email;
      header("Location: home.php");
      exit();
    } else {
      $error_message = "Invalid password.";
    }
  } else {
    $error_message = "Email not found.";
  }

  $stmt->close();
}

$conn->close();
?>

<!-- HTML Design -->
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-[#d7e0eb] to-[#f0f2f5] min-h-screen flex items-center justify-center p-4">
  <div class="bg-[#344154] rounded-2xl w-full max-w-sm p-8 flex flex-col items-center">
    <img alt="Logo" class="mb-4" height="40" src="https://storage.googleapis.com/a1aa/image/44093201-ff52-4755-3a93-cd92ec9a5590.jpg" width="40"/>
    <h1 class="text-white font-bold text-lg mb-6">LOGIN</h1>
    <form method="POST" class="w-full flex flex-col gap-4">
      <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
          <i class="fas fa-envelope"></i>
        </span>
        <input name="email" class="w-full rounded-lg bg-[#d7d7d7] text-gray-700 text-sm pl-10 pr-4 py-2 focus:outline-none" placeholder="Email" type="email" required />
      </div>
      <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
          <i class="fas fa-lock"></i>
        </span>
        <input name="password" class="w-full rounded-lg bg-[#d7d7d7] text-gray-700 text-sm pl-10 pr-4 py-2 focus:outline-none" placeholder="Password" type="password" required />
      </div>
      <button class="bg-[#0066FF] text-white font-semibold text-sm rounded-lg py-2 mt-2 w-full" type="submit">
        Login
      </button>
    </form>
    <div class="mt-6 text-center text-gray-300 text-xs">
      <p>Forgot password?</p>
      <a class="text-[#3399FF] font-semibold text-xs" href="register.php">Create an account</a>
    </div>

    <?php if (isset($error_message)): ?>
      <div class="mt-4 text-red-500 text-xs text-center"><?= $error_message ?></div>
    <?php endif; ?>
  </div>
</body>
</html>
