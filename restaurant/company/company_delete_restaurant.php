<?php

include('includes/header.php');
include '../config/dbcon.php'; 
include '../functions/company/restaurant_function.php';

$userId = $_SESSION['user_id'];
$companyInfo = getCompanyInfoByUserId( $userId);

$restaurantId = $_GET['id'] ?? 0;
$restaurant = getRestaurantById($restaurantId);

if (!$restaurant || $restaurant['company_id'] !== $companyInfo['id']) {
    $_SESSION['error_message'] = "Geçersiz restoran.";
    header("Location: company_restaurants.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = deleteRestaurant($restaurantId);
    if ($result) {
        $_SESSION['message'] = "Restoran başarıyla silindi.";
    } else {
        $_SESSION['error_message'] = "Restoran silinirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Sil</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="bgspecial">
<div class="container">
<?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info mt-3">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
    <h1>Restoran Sil</h1>
    
    <p>Bu restoranı silmek istediğinizden emin misiniz?</p>
    <p><strong><?= htmlspecialchars($restaurant['name']) ?></strong></p>
    
    <form method="POST">
        <button type="submit" class="btn">Evet, Sil</button>
        <a href="company_restaurants.php" class="btn">İptal</a>
    </form>
</div>
</div>
</body>
</html><?php include('includes/footer.php'); ?>