
<?php
session_start();
include('../../config/dbcon.php');
include('../../functions/admin/company_function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firma_id = $_POST['firma_id'];
    $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : null;
    $description = !empty($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8') : null;
    $user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : null;

    // Dosya işlemi (logo yükleme) kontrolü
    if (isset($_FILES['logo_path']) && $_FILES['logo_path']['error'] === 0) {
        $logo_path = 'uploads/' . basename($_FILES['logo_path']['name']);
        move_uploaded_file($_FILES['logo_path']['tmp_name'], $logo_path);
    } else {
        $logo_path = null;
    }

    // Şirket güncelleme işlemi
    if (update_company($firma_id, $name, $description, $user_id, $logo_path)) {
        $_SESSION['message'] = "Şirket bilgileri başarıyla güncellendi.";
    } else {
        $_SESSION['message'] = "Güncelleme yapılmadı. Lütfen en az bir alanı doldurun.";
    }

    // Yönlendirme işlemi
    header('Location: ../firma_guncelle_cont.php');
    exit();
}
?>
