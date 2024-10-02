<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Tüm oturum verilerini temizle
$_SESSION = array();

// Oturum çerezini yok et (eğer varsa)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Oturumu tamamen sonlandır
session_destroy();

// Kullanıcıyı giriş sayfasına veya başka bir sayfaya yönlendirme
header("Location: ../../login.php");
exit();

?>