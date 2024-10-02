<?php

session_start();
include '../../config/dbcon.php';
include '../../functions/admin/company_function.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_company($id);
    $_SESSION['message'] = "Şirket başarıyla silindi";
    header("Location: ../firma_ara_cont.php?message=Kullanıcı başarıyla silindi");
    exit;
} else {
    $_SESSION['message'] = "Şirket silinemedi";
    header("Location: ../firma_ara_cont.php?error=Geçersiz istek");
    exit;
}

?>