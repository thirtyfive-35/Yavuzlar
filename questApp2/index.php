
<?php
session_start();

// Kullanıcının oturum açıp açmadığını kontrol et
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {

  header("Location: login_page.php?message=You are not logged in!");
  exit();
} elseif ($_SESSION['is_admin'] === 'admin') {

  header("Location: admin_page.php");
  exit();
} elseif ($_SESSION['is_admin'] === 'user') {

  header("Location: user_page.php");
  exit();
}


?>
