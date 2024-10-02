<?php

$host = "db";  // Docker'da 'db' ismini kullanıyoruz
$username = "root";  // MySQL kullanıcı adı
$password = "12345";  // Şifre
$dbname = "restaurant-web-app";  // Veritabanı ismi

try {
    // Veritabanına bağlantı kurma
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Echo mesajı kaldırıldı
} catch (PDOException $e) {
    // Hata durumunda bağlantı hatasını yazdır
    error_log("Bağlantı hatası: " . $e->getMessage());
    // Kullanıcıya genel bir hata mesajı ver
    die("Veritabanına bağlanırken bir hata oluştu.");
}

// Bağlantıyı kapat
//$conn = null;
