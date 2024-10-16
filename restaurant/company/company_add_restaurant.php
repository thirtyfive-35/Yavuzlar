<?php

include('includes/header.php');
include '../config/dbcon.php'; 
include '../functions/company/restaurant_function.php';

$userId = $_SESSION['user_id'];
$companyInfo = getCompanyInfoByUserId($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_FILES['image'] ?? null;

    if (empty($name)) {
        $error = "Restoran adı boş olamaz.";
    } else {
        $result = addRestaurant($companyInfo['id'], $name, $description, $image);
        if ($result) {
            $_SESSION['message'] = "Restoran başarıyla eklendi.";
        } else {
            $error = "Restoran eklenirken bir hata oluştu.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Restoran Ekle</title>
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
    <h1>Yeni Restoran Ekle</h1>
    
    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Restoran Adı:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="description">Açıklama:</label>
        <textarea id="description" name="description"></textarea><br>
        
        <label for="image">Restoran Resmi:</label>
        <input type="file" id="image" name="image" accept="image/*">
        <br><br><br>
        <button type="submit" class="btn">Restoran Ekle</button>
    </form>
    
    <p><a href="company_restaurants.php" class="btn">Restoranlarıma Dön</a></p>
</div>
</div>
</body>
</html><?php include('includes/footer.php'); ?>