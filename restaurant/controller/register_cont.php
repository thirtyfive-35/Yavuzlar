<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config/dbcon.php';
include '../functions/authcode.php'; // authcode.php dosyasını dahil et

// Form verilerinin alındığını kontrol et
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen veriler
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "user"; // Varsayılan rol

    // register fonksiyonunu çağır
    register($name, $surname, $username, $password, $role);
} else {
    header('Location: ../register.php');
}
?>
