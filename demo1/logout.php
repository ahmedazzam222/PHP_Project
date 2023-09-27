<?php
session_start();
session_unset();
session_destroy();
header("Location: ../theme/login.php");
exit();
?>