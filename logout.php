<?php
session_start();
session_unset();
session_destroy();
session_start(); // Mulai session baru untuk set session logout_success
$_SESSION['logout_success'] = true;
header("Location: index.php");
exit();
?>