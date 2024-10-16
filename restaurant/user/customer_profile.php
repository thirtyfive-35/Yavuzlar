<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../middleware/userMiddleware2.php');
include('../functions/user/profile_function.php');
include('../config/dbcon.php');

$userId = $_SESSION['user_id'];
$user = getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $username = $_POST['username'] ?? '';

        if (updateUserProfile($userId, $name, $surname, $username)) {
            $_SESSION['success_message'] = "Profil bilgileriniz güncellendi.";
            $user = getUserById($userId); // Güncellenmiş bilgileri al
        } else {
            $_SESSION['error_message'] = "Profil güncellenirken bir hata oluştu.";
        }
    } elseif (isset($_POST['add_balance'])) {
        $amount = $_POST['amount'] ?? 0;
        if ($amount > 0) {
            if (addUserBalance($userId, $amount)) {
                $_SESSION['success_message'] = "Bakiyeniz başarıyla güncellendi.";
                $user = getUserById($userId); // Güncellenmiş bilgileri al
            } else {
                $_SESSION['error_message'] = "Bakiye eklenirken bir hata oluştu.";
            }
        } else {
            $_SESSION['error_message'] = "Geçersiz bakiye miktarı.";
        }
    }
}
include('includes/header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="bgspecial">
<div class="container">
    <h1>Profil</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <p class="success"><?= $_SESSION['success_message'] ?></p>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <p class="error"><?= $_SESSION['error_message'] ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <h2>Profil Bilgileri</h2>
    <form method="POST">
        <input type="hidden" name="update_profile" value="1">
        <label for="name">Ad:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        
        <label for="surname">Soyad:</label>
        <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required>
        <br>
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        <br><br><br>
        <button type="submit" class="btn">Profili Güncelle</button>
    </form>

    <h2>Bakiye</h2>
    <p>Mevcut Bakiye: <?= number_format($user['balance'], 2) ?> TL</p>
    <form method="POST">
        <input type="hidden" name="add_balance" value="1">
        <label for="amount">Eklenecek Miktar (TL):</label>
        <input type="number" id="amount" name="amount" min="1" step="0.01" required>
        
        <button type="submit" class="btn">Bakiye Ekle</button>
    </form>
</div>
</div>
</body>
</html>
<?php include('includes/footer.php'); ?>