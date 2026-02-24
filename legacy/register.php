<?php
session_start();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = 'Passwords do not match';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        include 'db_connect.php';

        // check if email already exists
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Email is already registered';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
            $insert->bind_param('ss', $email, $hashed);
            if ($insert->execute()) {
                $success = 'Registration successful! <a href="login.php">Login now</a>.';
            } else {
                $error = 'Registration failed, please try again later';
            }
            $insert->close();
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <?php
        if ($error) {
            echo "<p style='color:red;'>$error</p>";
        }
        if ($success) {
            echo "<p style='color:green;'>$success</p>";
        }
        ?>
        <form method="POST" action="register.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
