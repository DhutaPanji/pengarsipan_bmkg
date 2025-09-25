<?php
session_start();
session_unset();
session_destroy();

// redirect ke login di folder yang sama
header("Location: login.php");
exit;
