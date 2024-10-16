<?php

session_start();
include '../../config/dbcon.php';
include '../../functions/company/food_function.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $restaurant_id = htmlspecialchars($_POST['restaurant_id']);
    $price = htmlspecialchars($_POST['price']);


    $result = add_food($name, $description, $restaurant_id, $price);
    if($result)
    {
       $_SESSION['message'] = "Yemek başarıyla eklendi.";
        header('Location: ../yemek_ekle.php');
    }
    else
    {
        $_SESSION['message'] = "Yemek eklenirken bir hata oluştu. Lütfen tekrar deneyin.";
        header('Location: ../yemek_ekle.php');
    }
} else {
    echo "Geçersiz istek.";
    header('Location: ../yemek_ekle.php');
}
?>

