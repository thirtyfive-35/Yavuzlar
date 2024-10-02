<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../config/dbcon.php');
include('../../functions/user/basket_function.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $food_id = isset($_POST['food_id']) ? $_POST['food_id'] : null;
        $restaurant_id = isset($_POST['restaurant_id']) ? $_POST['restaurant_id'] : null;
        $action = isset($_POST['action']) ? $_POST['action'] : null;

        // Gelen verilerin kontrolü
        if ($food_id && $restaurant_id && $action) {
            // İşleme göre fonksiyonu çağır
            if ($action === 'increase') {
                increase_quantity($user_id, $food_id); // Sepetteki ürünü arttır
                $_SESSION['message'] = "Ürün miktarı arttırıldı.";
            } elseif ($action === 'decrease') {
                decrease_quantity($user_id, $food_id); // Sepetteki ürünü azalt
                $_SESSION['message'] = "Ürün miktarı azaltıldı.";
            }

            // Sepet sayfasına geri yönlendirme
            header('Location: ../../cart.php');
            exit();
        } else {
            // Gerekli veriler eksikse hata mesajı
            $_SESSION['message'] = "Eksik veri gönderildi.";
            header('Location: ../../cart.php');
            exit();
        }
    } else {
        // Kullanıcı giriş yapmamışsa
        $_SESSION['message'] = "Giriş yapmalısınız.";
        header('Location: ../../login.php');
        exit();
    }
} else {
    header('Location: ../../test.php');
    exit();
}
