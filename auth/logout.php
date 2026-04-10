<?php
session_start();

// hapus semua session
session_unset();
session_destroy();

// redirect ke login
header("Location:../auth/login.php");
exit;
?>