
<?php
session_start();
include '../config/dbcon.php';
include '../functions/authcode.php'; // authcode.php dosyasını dahil et

// Form verilerinin alındığını kontrol et
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen veriler
    $username = $_POST['username'];
    $password = $_POST['password'];

    // login fonksiyonunu çağır
    $user = login($username, $password);

    if ($user) {
        $_SESSION['auth'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['message'] = "Giriş başarılı!";
        if ($_SESSION['role'] == "user") {
            header('Location: ../index.php'); // Ana sayfaya yönlendir
            exit;
        } else if ($_SESSION['role'] == "admin") {
            header('Location: ../admin/index.php'); // Ana sayfaya yönlendir
            exit;
        } else if ($_SESSION['role'] == "firma") {
            header('Location: ../company/index.php'); // Ana sayfaya yönlendir
            exit;
        }
    } else {
        // Hatalı giriş
        $_SESSION['message'] = "Kullanıcı adı veya şifre yanlış!";
        header('Location: ../login.php');
        exit;
    }
} else {
    echo "Geçersiz istek.";
    header('Location: ../login.php');
}
?>
