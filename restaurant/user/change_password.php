<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../middleware/userMiddleware2.php');
include('../functions/user/profile_function.php');
include('../config/dbcon.php');

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($newPassword === $confirmPassword) {
        if (changeUserPassword($userId, $currentPassword, $newPassword)) {
            $_SESSION['success_message'] = "Şifreniz başarıyla değiştirildi.";
            header("Location: customer_profile.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Şifre değiştirilemedi. Mevcut şifrenizi kontrol edin.";
        }
    } else {
        $_SESSION['error_message'] = "Yeni şifreler eşleşmiyor.";
    }
}
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Değiştir</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="bgspecial">
<div class="container">
    <h1>Şifre Değiştir</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <p class="success"><?= $_SESSION['success_message'] ?></p>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <p class="error"><?= $_SESSION['error_message'] ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form method="POST">
        <label for="current_password">Mevcut Şifre:</label>
        <input type="password" id="current_password" name="current_password" required>
        <br><br>
        <label for="new_password">Yeni Şifre:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br><br>
        <label for="confirm_password">Yeni Şifre (Tekrar):</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit" class="btn">Şifre Değiştir</button>
    </form>
</div>
</div>
</body>
</html>

<?php include('includes/footer.php'); ?>