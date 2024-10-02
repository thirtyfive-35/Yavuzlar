<?php

function get_food_detail($restaurant_id)
{
    global $conn;

    $sql = "SELECT *  FROM food WHERE restaurant_id = :restaurant_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':restaurant_id', $restaurant_id);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function add_comment($user_id, $restaurant_id, $surname, $title, $description, $score)
{
    try {

        global $conn;

        $query = "INSERT INTO comments (user_id, restaurant_id, surname, title, description, score, created_at, updated_at) 
                  VALUES (:user_id, :restaurant_id, :surname, :title, :description, :score, NOW(), NOW())";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':restaurant_id', $restaurant_id);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':score', $score);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
function get_comments($restaurant_id)
{
    global $conn;

    $sql = "SELECT * FROM comments WHERE restaurant_id = :restaurant_id ORDER BY created_at DESC";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':restaurant_id', $restaurant_id);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}



?>