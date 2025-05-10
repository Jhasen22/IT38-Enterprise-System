<?php
session_start();

// Connect to MySQL
$mysqli = new mysqli("localhost", "root", "", "hardwarehub");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$success_message = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check for duplicate email
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = "Email is already registered.";
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_password);
            if ($stmt->execute()) {
                $success_message = "Registration successful. You can now <a href='login.php' class='text-[#3399FF]'>login</a>.";
            } else {
                $error_message = "Something went wrong. Please try again.";
            }
        }
        $stmt->close();
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Register Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-r from-[#d7e0eb] to-[#f0f2f5] min-h-screen flex items-center justify-center p-4">
  <div class="bg-[#344154] rounded-2xl w-full max-w-sm p-8 flex flex-col items-center">
    <img alt="Logo" class="mb-4" height="40" src="https://storage.googleapis.com/a1aa/image/44093201-ff52-4755-3a93-cd92ec9a5590.jpg" width="40"/>
    <h1 class="text-white font-bold text-lg mb-6">REGISTER</h1>
    
    <form method="POST" class="w-full flex flex-col gap-4">
      <!-- Email -->
      <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
          <i class="fas fa-envelope"></i>
        </span>
        <input name="email" type="email" required placeholder="Email"
          class="w-full rounded-lg bg-[#d7d7d7] text-gray-700 text-sm pl-10 pr-4 py-2 focus:outline-none"/>
      </div>

      <!-- Password -->
      <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
          <i class="fas fa-lock"></i>
        </span>
        <input name="password" type="password" required placeholder="Password"
          class="w-full rounded-lg bg-[#d7d7d7] text-gray-700 text-sm pl-10 pr-4 py-2 focus:outline-none"/>
      </div>

      <!-- Confirm Password -->
      <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
          <i class="fas fa-lock"></i>
        </span>
        <input name="confirm_password" type="password" required placeholder="Confirm Password"
          class="w-full rounded-lg bg-[#d7d7d7] text-gray-700 text-sm pl-10 pr-4 py-2 focus:outline-none"/>
      </div>

      <button type="submit"
        class="bg-[#0066FF] text-white font-semibold text-sm rounded-lg py-2 mt-2 w-full">
        Register
      </button>
    </form>

    <?php if (!empty($error_message)): ?>
      <div class="mt-4 text-red-500 text-xs text-center"><?= $error_message ?></div>
    <?php elseif (!empty($success_message)): ?>
      <div class="mt-4 text-green-500 text-xs text-center"><?= $success_message ?></div>
    <?php endif; ?>

    <div class="mt-6 text-center text-gray-300 text-xs">
      <a class="text-[#3399FF] font-semibold text-xs" href="login.php">Already have an account? Login</a>
    </div>
  </div>
</body>
</html>
