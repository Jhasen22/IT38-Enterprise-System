<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HardwareHub - Login</title>
    <style>
        body {
            background-color: #000; /* black background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* full height */
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 350px;
            text-align: center;
        }
        .login-container .site-title {
            font-size: 28px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 10px;
        }
        .login-container h2 {
            margin-bottom: 25px;
            color: #333;
            font-size: 22px;
        }
        .login-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF; /* blue button */
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-container button:hover {
            background-color: #0056b3; /* darker blue on hover */
        }
        .login-container .links {
            margin-top: 20px;
        }
        .login-container .links a {
            display: block;
            color: #007BFF;
            text-decoration: none;
            margin-top: 8px;
            font-size: 14px;
            transition: color 0.3s;
        }
        .login-container .links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="site-title">HardwareHub</div> <!-- Site name -->
    <h2>Login</h2>
    <form action="process_login.php" method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        <div class="links">
            <a href="forgot_password.php">Forgot Password?</a>
            <a href="register.php">Create Account</a> <!-- Link to register page -->
        </div>
    </form>
</div>

</body>
</html>
