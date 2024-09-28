<?php

session_start();
include '../../config/dbcon.php';
include '../../functions/admin/user_function.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);


    add_user($name, $surname, $username, $password, $role);
    $_SESSION['message'] = "kullanici Basarılı bir şekilde eklendi";
    header('Location: ../musteri_ekle.php');
} else {
    $_SESSION['message'] = "kullanici eklenemedi";
    header('Location: ../musteri_ekle.php');
}
?>


?>