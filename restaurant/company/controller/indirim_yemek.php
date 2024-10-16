<?php
session_start();
include('../../config/dbcon.php');
include('../../functions/company/food_function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = intval($_POST['food_id']);
    $discount = intval($_POST['discount']);

    // İndirim ekleme işlemi
    if (add_discount($id, $discount)) {
        $_SESSION['message'] = "İndirim başarıyla eklendi.";
    } else {
        $_SESSION['message'] = "Güncelleme yapılmadı.";
    }

    // Yönlendirme işlemi
    header('Location: ../yemek_listele_cont.php');
    exit();
} else {
    // Hatalı erişim durumunda yönlendirme
    $_SESSION['message'] = "Geçersiz erişim.";
    header('Location: ../yemek_listele_cont.php');
    exit();
}
?>
