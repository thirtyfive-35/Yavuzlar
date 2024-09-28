
<?php
session_start();
include('../../config/dbcon.php');
include('../../functions/company/food_function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $restaurant_id = $_POST['restaurant_id'];
    $id = $_POST['id'];
    $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : null;
    $description = !empty($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8') : null;
    $price = !empty($_POST['price']) ? htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8') : null;

    
    // Şirket güncelleme işlemi
    if (update_food($restaurant_id,$id, $name, $description, $price)) {
        $_SESSION['message'] = "Şirket bilgileri başarıyla güncellendi.";
    } else {
        $_SESSION['message'] = "Güncelleme yapılmadı. Lütfen en az bir alanı doldurun.";
    }

    // Yönlendirme işlemi
    header('Location: ../yemek_guncelle_cont.php');
    exit();
}
?>
