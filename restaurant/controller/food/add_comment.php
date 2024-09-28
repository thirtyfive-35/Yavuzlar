<?php
include('../../config/dbcon.php');
include('../../functions/user/food_function.php');
session_start();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];

    // Formdan gelen diğer veriler
    $restaurant_id = $_POST['restaurant_id']; // Bu değeri formda gizli bir input ile alabilirsiniz
    $surname = $_POST['surname'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $score = $_POST['score']; // 1-5 arasında bir puan olacak

    $result = add_comment($user_id, $restaurant_id, $surname, $title, $description, $score);
    if ($result) {
        // Başarılı
        $_SESSION['message'] = "Yorum başarıyla eklendi.";
        header('Location: ../../restaurant_goruntule.php?id=' . $restaurant_id);
    } else {
        // Başarısız
        $_SESSION['message'] = "Yorum eklenirken bir hata oluştu. Lütfen tekrar deneyin.";
        header('Location: ../../restaurant_goruntule.php');
    }
} else {
    echo "Geçersiz istek.";
    header('Location: ../../restaurant_goruntule.php');
    exit();
}
