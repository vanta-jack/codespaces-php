<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    include 'db_connect.php';

    // fetch the hashed password for the supplied email
    $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($id, $hash);

    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $stmt->close();
        $conn->close();
        header('Location: index.php'); // Redirect to main page
        exit;
    } else {
        $error = 'Invalid email or password';
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>
</html>