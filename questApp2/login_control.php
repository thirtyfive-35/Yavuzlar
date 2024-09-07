<?php

session_start();
include "functions/userFunctions.php";
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php?message=Kullanıcı adı ve şifre boş bırakılamaz!");
    die();
} else {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $result = Login($username, $password, $role);
    $rowCount = $result['count'];

    if ($rowCount == 0) {
        header("Location: login.php?message=Kullanıcı adı veya şifre yanlış!");
        die();
    }

    // Kullanıcı bilgilerini oturumda sakla
    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['is_admin'] = $role;

    header("Location: admin_page.php");
    die();
}
