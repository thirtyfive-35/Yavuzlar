<?php
session_start();
include '../../config/dbcon.php';
include '../../functions/admin/cupon_function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $discount = htmlspecialchars($_POST['discount']);
    $kupon_id = htmlspecialchars($_POST['kupon_id']);
    $restaurant_id = htmlspecialchars($_POST['restaurant_id']);

    $result = update_cupon($kupon_id, $name, $discount, $restaurant_id);

    if ($result) {
        // Başarılı
        $_SESSION['message'] = "Kupon başarıyla eklendi.";
        header('Location: ../kupon_sil.php');
    } else {
        // Başarısız
        $_SESSION['message'] = "Kupon eklenirken bir hata oluştu. Lütfen tekrar deneyin.";
        header('Location: ../kupon_sil.php');
    }
    exit();
} else {
    echo "Geçersiz istek.";
    header('Location: ../kupon_sil.php');
    exit();
}
?>
