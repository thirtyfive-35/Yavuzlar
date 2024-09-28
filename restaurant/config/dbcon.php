
<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant-web-app";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Başarıyla bağlanıldı";
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

// Bağlantıyı kapat
//$conn = null;
?>
