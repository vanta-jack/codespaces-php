<?php
// db_connect.php
// Establish a connection to the MariaDB database and reuse it across pages.
// Adjust the credentials as needed (for example from environment variables
// in a production deployment).

// use TCP localhost address so mysqli uses network connection instead of
// attempting a socket (which occasionally isn’t found inside the container).
$host = '127.0.0.1';
$db   = 'login_db';
// use a dedicated application account rather than root; adjust if you change
$user = 'webuser';
$pass = 'password';

// ensure the mysqli extension is available; otherwise provide a helpful message
if (!class_exists('mysqli')) {
    die("The mysqli extension is not enabled.\n" .
        "Install the PHP MySQL extension (e.g. php-mysqli or php-mysql) " .
        "and restart your server.\n");
}

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>