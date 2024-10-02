<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../../config/dbcon.php');
include('../../functions/user/basket_function.php');


if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];

    // Formdan gelen diğer veriler
    $product_id = $_POST['product_id'];
    $restaurant_id = $_POST['restaurant_id'];


    $result = add_basket($product_id, $user_id);
    if ($result) {
        // Başarılı
        $_SESSION['message'] = "Ürün başarıyla eklendi.";
        header('Location: ../../restaurant_goruntule.php?id=' . $restaurant_id);
    } else {
        // Başarısız
        $_SESSION['message'] = "Ürün eklenirken bir hata oluştu. Lütfen tekrar deneyin.";
        header('Location: ../../test.php');
    }
} else {
    header('Location: test.php');
    exit();
}
?>