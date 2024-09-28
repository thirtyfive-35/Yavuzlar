<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../config/dbcon.php');
include('../../functions/user/basket_function.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Formdan gelen veriler
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
    // Geçersiz istek
    echo "Geçersiz istek.";
    header('Location: ../../test.php');
    exit();
}
