
<?php

function add_basket($food_id, $user_id)
{
    global $conn;

    // Öncelikle kullanıcı için mevcut kaydı kontrol et
    $sql = "SELECT quantity FROM basket WHERE food_id = :food_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':food_id', $food_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // Mevcut kayıt varsa, quantity değerini artır
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $new_quantity = $row['quantity'] + 1; // Mevcut quantity değerini 1 artır

        $update_sql = "UPDATE basket SET quantity = :quantity WHERE food_id = :food_id AND user_id = :user_id";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bindParam(':quantity', $new_quantity);
        $update_stmt->bindParam(':food_id', $food_id);
        $update_stmt->bindParam(':user_id', $user_id);

        return $update_stmt->execute();
    } else {
        // Eğer kayıt yoksa, yeni bir kayıt ekle
        $sql = "INSERT INTO basket (food_id, user_id, quantity) VALUES (:food_id, :user_id, :quantity)";
        $stmt = $conn->prepare($sql);

        $quantity = 1;

        $stmt->bindParam(':food_id', $food_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':quantity', $quantity);

        return $stmt->execute();
    }
}

function get_basket($user_id)
{
    global $conn;
    $sql = "SELECT b.food_id,f.restaurant_id, f.name, f.price, b.quantity FROM basket b INNER JOIN food f ON b.food_id = f.id WHERE b.user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Sepet güncelleme fonksiyonları
function increase_quantity($user_id, $food_id)
{
    global $conn;
    $sql = "UPDATE basket SET quantity = quantity + 1 WHERE user_id = :user_id AND food_id = :food_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':food_id', $food_id);
    $stmt->execute();
}

function decrease_quantity($user_id, $food_id)
{
    global $conn;
    // Miktarı 1'in altına düşmemesi için kontrol
    $sql = "SELECT quantity FROM basket WHERE user_id = :user_id AND food_id = :food_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':food_id', $food_id);
    $stmt->execute();
    $quantity = $stmt->fetchColumn();

    if ($quantity > 1) {
        $sql = "UPDATE basket SET quantity = quantity - 1 WHERE user_id = :user_id AND food_id = :food_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':food_id', $food_id);
        $stmt->execute();
    }
}


?>
