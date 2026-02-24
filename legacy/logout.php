<?php
session_start();
// clear session data and redirect to login
session_unset();
session_destroy();
header('Location: login.php');
exit;
?>