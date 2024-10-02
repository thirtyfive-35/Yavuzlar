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

?>