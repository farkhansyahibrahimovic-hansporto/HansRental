<?php
session_start();

// Menghapus semua variabel session
$_SESSION = [];

// Menghancurkan session
session_destroy();

// Mengarahkan pengguna kembali ke login.php
header("Location: login.php");
exit();
?>