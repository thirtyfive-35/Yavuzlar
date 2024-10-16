<?php

function add_cupon($name, $discount, $restaurant_id)
{
    global $conn;

    $sql = "INSERT INTO cupon (name, discount, restaurant_id) VALUES (:name, :discount, :restaurant_id)";
    $stmt = $conn->prepare($sql);


    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':discount', $discount);
    $stmt->bindParam(':restaurant_id', $restaurant_id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function get_cupon()
{
    global $conn;

    $sql = "SELECT * FROM cupon";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}


function delete_cupon($id)
{
    global $conn;

    // Kullanıcının silinme tarihini güncelle
    $sql = "UPDATE cupon SET deleted_at = NOW() WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function update_cupon($id, $name, $discount, $restaurant_id)
{
    global $conn;

    // Güncelleme sorgusu
    $sql = "UPDATE cupon SET name = :name, discount = :discount, restaurant_id = :restaurant_id WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Parametreleri bağlama
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':discount', $discount);
    $stmt->bindParam(':restaurant_id', $restaurant_id);

    // Sorguyu çalıştırma
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


?>