<?php

session_start();
include '../../config/dbcon.php';
include '../../functions/admin/user_function.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_user($id);
    $_SESSION['message'] = "Kullanıcı başarıyla silindi";
    header("Location: ../musteri_ara_cont.php?message=Kullanıcı başarıyla silindi");
    exit;
} else {
    $_SESSION['message'] = "Geçersiz istek";
    header("Location: ../musteri_ara_cont.php?error=Geçersiz istek");
    exit;
}



?>