<?php
session_start();
include '../../config/dbcon.php';
include '../../functions/admin/cupon_function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $discount = htmlspecialchars($_POST['discount']);
    $restaurant_id = htmlspecialchars($_POST['restaurant_id']);

    $result = add_cupon($name, $discount, $restaurant_id);

    if ($result) {
        // Başarılı
        $_SESSION['message'] = "Kupon başarıyla eklendi.";
        header('Location: ../kupon_ekle.php');
    } else {
        // Başarısız
        $_SESSION['message'] = "Kupon eklenirken bir hata oluştu. Lütfen tekrar deneyin.";
        header('Location: ../kupon_ekle.php');
    }
    exit();
} else {
    echo "Geçersiz istek.";
    header('Location: ../kupon_ekle.php');
    exit();
}
?>
