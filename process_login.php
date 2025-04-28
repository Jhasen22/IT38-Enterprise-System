<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $host = 'localhost';
    $db = 'simple_login';
    $user = 'root'; // default XAMPP username
    $password = ''; // default XAMPP password

    $conn = new mysqli($host, $user, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Get user input
    $username = trim($_POST['username']);
    $password_input = trim($_POST['password']);

    // Prepare statement to avoid SQL Injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password_from_db);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password_input, $hashed_password_from_db)) {
            // Password is correct
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            // Wrong password
            echo "Invalid username or password.";
        }
    } else {
        // No user found
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
