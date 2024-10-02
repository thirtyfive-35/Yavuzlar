<?php

include('redirect.php');

function register($name, $surname, $username, $password, $role)
{
    global $conn; // Veritabanı bağlantısını kullanmak için global olarak alıyoruz

    // Şifreleri kontrol et
    if ($password !== $_POST['confirmPassword']) {
        $_SESSION['message'] = "Şifreler uyuşmuyor!";
        header('Location: ../register.php');
        exit;
    }

    // Şifreyi hash'le
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

    // SQL sorgusu (Kullanıcıyı veritabanına ekle)
    $sql = "INSERT INTO users (role, name, surname, username, password) VALUES (:role, :name, :surname, :username, :password)";
    $stmt = $conn->prepare($sql);

    // Parametreleri bağla
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    try {
        if ($stmt->execute()) {
            $_SESSION['message'] = "Kayıt başarıyla eklendi!";
            header('Location: ../login.php');
            exit;
        } else {
            $_SESSION['message'] = "Kayıt sırasında bir hata oluştu!";
            header('Location: ../register.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Bir hata oluştu: " . $e->getMessage();
        header('Location: ../register.php');
        exit;
    }
}

function login($username, $password)
{
    global $conn;

    // Kullanıcıyı veritabanından al
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Kullanıcı mevcutsa
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Şifreyi kontrol et
        if (password_verify($password, $user['password'])) {
            return $user; // Başarılı giriş, kullanıcı verisi döndür
        }
    }
    return false; // Giriş hatası
}

?>