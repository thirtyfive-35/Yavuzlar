<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../config/dbcon.php');
include('../../functions/user/order_function.php');

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];

    // Formdan gelen diğer veriler
    $note = $_POST['note'];

    $result = order($user_id);
    if ($result) {
        // Başarılı
        $_SESSION['message'] = "Ürün başarıyla Satın alındı.";
        header('Location: ../../cart.php');
    } else {
        // Başarısız
        $_SESSION['message'] = "Ürün alınırken bir hata oluştu. Lütfen tekrar deneyin.";
        header('Location: ../../cart.php');
    }
} else {
    header('Location: cart.php');
    exit();
}
