<?php


function add_food($name, $description, $restaurant_id, $price)
{
    global $conn;

    // Yemek ekleme sorgusu
    $sql = "INSERT INTO food (name, description, price, restaurant_id) VALUES (:name, :description, :price, :restaurant_id)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':restaurant_id', $restaurant_id);
    $stmt->bindParam(':price', $price);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function get_restaurant_detail()
{
    global $conn;

    $sql = "SELECT c.name AS company_name, r.name AS restaurant_name, f.name AS food_name, f.description, f.price, f.discount 
            FROM company c 
            INNER JOIN restaurant r ON c.id = r.company_id 
            INNER JOIN food f ON r.id = f.restaurant_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}


function update_food($restaurant_id, $id, $name = null, $description = null, $price = null)
{
    global $conn;

    $query = "UPDATE food SET ";

    $fields_to_update = "";

    if (!empty($name)) {
        $fields_to_update .= "name = :name, ";
    }

    if (!empty($description)) {
        $fields_to_update .= "description = :description, ";
    }
    if (!empty($restaurant_id)) {
        $fields_to_update .= "restaurant_id = :restaurant_id, ";
    }

    $fields_to_update = rtrim($fields_to_update, ", ");

    if (!empty($fields_to_update)) {
        $query .= $fields_to_update . " WHERE id = :id";

        $stmt = $conn->prepare($query);

        if (!empty($name)) {
            $stmt->bindParam(':name', $name);
        }
        if (!empty($description)) {
            $stmt->bindParam(':description', $description);
        }
        if (!empty($restaurant_id)) {
            $stmt->bindParam(':restaurant_id', $restaurant_id);
        }

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


function get_restaurant_name_and_id()
{
    global $conn;

    $sql = "SELECT id, name FROM restaurant";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function get_food_name_and_id()
{
    global $conn;

    $sql = "SELECT id, name FROM food";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function search_food($name, $active)
{
    global $conn;

    $sql = "SELECT c.name AS company_name, r.name AS restaurant_name, f.name AS food_name, f.description, f.price, f.discount 
            FROM company c 
            INNER JOIN restaurant r ON c.id = r.company_id 
            INNER JOIN food f ON r.id = f.restaurant_id
            INNER JOIN users u ON u.company_id = c.id
             WHERE (f.name LIKE :name OR :name = '')
            AND u.role = 'firma' ";

    if ($active == 1) {
        $sql .= "AND c.deleted_at IS NULL ";
    }

    $stmt = $conn->prepare($sql);

    $name = "%$name%";

    $stmt->bindParam(':name', $name);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
