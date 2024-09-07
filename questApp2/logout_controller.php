
<?php
session_start();

// Oturumu sonlandır
session_unset();
session_destroy();

// Giriş sayfasına yönlendir
header("Location: login_page.php?message=You have been logged out!");
exit;
?>
