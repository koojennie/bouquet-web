<?php
session_start();
session_unset();
session_destroy();
$_SESSION['logout_success'] = true;
header("Location: index.php");
exit();
?>
