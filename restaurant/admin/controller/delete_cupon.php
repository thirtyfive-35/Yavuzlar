<?php

session_start();
include '../../config/dbcon.php';
include '../../functions/admin/cupon_function.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_cupon($id);
    $_SESSION['message'] = "Kupon başarıyla silindi";
    header("Location: ../kupon_sil.php");
    exit;
} else {
    $_SESSION['message'] = "Geçersiz istek";
    header("Location: ../kupon_sil.php");
    exit;
}
