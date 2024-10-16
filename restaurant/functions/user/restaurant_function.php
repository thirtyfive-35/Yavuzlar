<?php

function get_restaurant_info()
{
    global $conn;

    $sql = "SELECT * FROM restaurant";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function searchRestaurants($search = '') {
    global $conn;
    $sql = "SELECT r.*, AVG(c.score) as average_score
            FROM restaurant r
            LEFT JOIN comments c ON r.id = c.restaurant_id
            WHERE r.name LIKE ?
            GROUP BY r.id, r.name, r.description, r.image_path
            ORDER BY average_score DESC, r.name";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$search%"]);
    return $stmt->fetchAll();
}

?>