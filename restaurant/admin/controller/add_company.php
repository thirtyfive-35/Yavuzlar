<?php

session_start();
include '../../config/dbcon.php';
include '../../functions/admin/company_function.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = htmlspecialchars($_POST['user_id']);
    $logo_path = "TEST";


    add_company($name, $description, $logo_path, $user_id);
} else {
    header('Location: ../firma_ekle.php');
}
?>


?>