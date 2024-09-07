<?php
session_start();
include "functions/questUserFunctions.php";

// Kullanıcının oturum açıp açmadığını kontrol et
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login_page.php?message=You are not logged in!");
    exit();
}

// Tüm kullanıcıların skorlarını al
$user_scores = GetAllUserScores();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Skorları</title>
    <link rel="stylesheet" href="styles.css"> <!-- İsteğe bağlı: Stil dosyanız varsa -->
</head>

<body>
    <div class="container">
        <h1>Kullanıcı Skorları</h1>

        <?php if (count($user_scores) > 0): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>Toplam Puan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_scores as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['total_score']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Henüz skor kaydı bulunmuyor.</p>
        <?php endif; ?>

        <!-- Ana sayfaya veya başka bir sayfaya geri dönmek için bir düğme -->
        <form action="user_page.php" method="get">
            <button type="submit">Ana Sayfaya Dön</button>
        </form>
    </div>
</body>

</html>