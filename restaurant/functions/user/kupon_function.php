<?php

function get_restaurant_kupon()
{
    global $conn;

    $sql = "SELECT c.name AS company_name, c.discount AS discount_total, r.name AS restaurant_name
            FROM cupon c 
            INNER JOIN restaurant r ON c.restaurant_id = r.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

?>