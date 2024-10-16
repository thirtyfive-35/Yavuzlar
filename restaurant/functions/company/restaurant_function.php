<?php

function get_company($id)
{
    global $conn;

    $sql = "SELECT company_id FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['company_id']; 
}

function add_restaurant($user_id, $name, $description, $image_path)
{
    global $conn;
    
    $company_id = get_company($user_id);
    
    $sql = "INSERT INTO restaurant (name, description, image_path, company_id) VALUES (:name, :description, :image_path, :company_id)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':company_id', $company_id);
    $stmt->bindParam(':image_path', $image_path);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function getCompanyInfoByUserId($userId) {
    global $conn;

    $sql = "SELECT c.* FROM company c
            JOIN users u ON c.id = u.company_id
            WHERE u.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetch();
}
function getRestaurantsByCompanyId($companyId) {
    global $conn;

    $sql = "SELECT * FROM restaurant WHERE company_id = ? ORDER BY name";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$companyId]);
    return $stmt->fetchAll();
}

function addRestaurant($companyId, $name, $description, $image = null) {

    global $conn;

    $sql = "INSERT INTO restaurant (company_id, name, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$companyId, $name, $description]);

    if ($result && $image && $image['error'] === UPLOAD_ERR_OK) {
        $restaurantId = $conn->lastInsertId();
        $imagePath = uploadImage($image, 'restaurant_images');
        $sql = "UPDATE restaurant SET image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$imagePath, $restaurantId]);
    }

    return $result;
}

function uploadImage($file, $directory) {
    $targetDir = "/var/www/html/uploads/" . $directory . "/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    $fileName = uniqid() . "_" . basename($file["name"]);
    $targetFile = $targetDir . $fileName;
    
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return "/uploads/" . $directory . "/" . $fileName;
    } else {
        throw new Exception("Dosya yüklenirken bir hata oluştu: " . error_get_last()['message']);
    }
}

function getRestaurantById($restaurantId) {
    global $conn;
    
    $sql = "SELECT * FROM restaurant WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$restaurantId]);
    return $stmt->fetch();
}

function updateRestaurant($restaurantId, $name, $description, $image = null) {
    global $conn;

    $sql = "UPDATE restaurant SET name = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$name, $description, $restaurantId]);

    if ($result && $image && $image['error'] === UPLOAD_ERR_OK) {
        $imagePath = uploadImage($image, 'restaurant_images');
        $sql = "UPDATE restaurant SET image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$imagePath, $restaurantId]);
    }

    return $result;
}

function deleteRestaurant($restaurantId) {
    global $conn;

    // Önce ilişkili yemekleri silelim
    $sql = "UPDATE food SET deleted_at = CURRENT_TIMESTAMP WHERE restaurant_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$restaurantId]);

    // Şimdi restoranı silelim
    $sql = "DELETE FROM restaurant WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$restaurantId]);
}

function deleteFood($foodId) {
    global $conn;

    $sql = "UPDATE food SET deleted_at = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$foodId]);
}

?>