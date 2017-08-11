<?php
session_start();
unset($_SESSION['userType']);
session_destroy();

header("Location: ../index.php");
exit;
?>
