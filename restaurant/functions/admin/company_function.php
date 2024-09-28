
<?php


function add_company($name, $description, $logo_path, $user_id)
{
    global $conn;

    // Şirketi ekleme sorgusu
    $sql = "INSERT INTO company (name, description, logo_path) VALUES (:name, :description, :logo_path)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':logo_path', $logo_path);

    try {

        if ($stmt->execute()) {
            // Eklenen şirketin id'sini alıyoruz
            $company_id = $conn->lastInsertId();

            $sqlUpdate = "UPDATE users SET company_id = :company_id WHERE id = :user_id";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':company_id', $company_id);
            $stmtUpdate->bindParam(':user_id', $user_id);

            // Kullanıcının company_id'sini güncelle
            if ($stmtUpdate->execute()) {
                $_SESSION['message'] = "Şirket başarıyla eklendi ve kullanıcı güncellendi!";
                header('Location: ../firma_ekle.php');
                exit;
            } else {
                $_SESSION['message'] = "Kullanıcı güncellenirken bir hata oluştu!";
                header('Location: ../firma_ekle.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "Şirket kaydı sırasında bir hata oluştu!";
            header('Location: ../firma_ekle.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Bir hata oluştu: " . $e->getMessage();
        header('Location: ../firma_ekle.php');
        exit;
    }
}


function delete_company($id)
{
    global $conn;

    $sql = "UPDATE company SET deleted_at = NOW() WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function search_company($name, $active)
{
    global $conn;

    $sql = "SELECT c.id, c.name, c.description, c.logo_path, c.deleted_at, u.id AS user_id, u.username
            FROM company c 
            INNER JOIN users u ON c.id = u.company_id
            WHERE (c.name LIKE :name OR :name = '')
            AND u.role = 'firma' AND u.deleted_at IS NULL ";

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

function get_name_and_id()
{
    global $conn;

    $sql = "SELECT name,id
            FROM company";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function update_company($firma_id, $name = null, $description = null, $user_id = null)
{
    global $conn;

    $query = "UPDATE company SET ";

    $fields_to_update = "";

    if (!empty($name)) {
        $fields_to_update .= "name = :name, ";
    }

    if (!empty($description)) {
        $fields_to_update .= "description = :description, ";
    }

    $fields_to_update = rtrim($fields_to_update, ", ");

    if (!empty($fields_to_update)) {
        $query .= $fields_to_update . " WHERE id = :firma_id";

        $stmt = $conn->prepare($query);

        if (!empty($name)) {
            $stmt->bindParam(':name', $name);
        }
        if (!empty($description)) {
            $stmt->bindParam(':description', $description);
        }

        $stmt->bindParam(':firma_id', $firma_id);

        $stmt->execute();

        if (!empty($user_id)) {
            $reset_query = "UPDATE users SET company_id = NULL WHERE company_id = :firma_id";

            $stmt_reset = $conn->prepare($reset_query);
            $stmt_reset->bindParam(':firma_id', $firma_id);
            $stmt_reset->execute();

            $query_user = "UPDATE users SET company_id = :firma_id WHERE id = :user_id";

            $stmt2 = $conn->prepare($query_user);

            $stmt2->bindParam(':firma_id', $firma_id);
            $stmt2->bindParam(':user_id', $user_id);

            $stmt2->execute();
        }

        return true;
    } else {
        return false;
    }
}





?>