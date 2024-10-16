<?php

session_start();
include('../../config/dbcon.php');
include('../../functions/company/restaurant_function.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Şirket güncelleme işlemi
    if (deleteFood($id)) {
        $_SESSION['message'] = "Yemek  başarıyla Silindi.";
    } else {
        $_SESSION['message'] = "Güncelleme yapılmadı.";
    }

    // Yönlendirme işlemi
    header('Location: ../yemek_listele_cont.php');
    exit();
}
?>
