
<?php

function get_restaurant_name_and_id()
{
    global $conn;

    $sql = "SELECT id, name FROM restaurant";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

?>