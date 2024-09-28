
<?php


function search_user($name, $surname, $active)
{
    global $conn;

    $sql = "SELECT id, name, surname, username, balance, created_at, deleted_at 
        FROM users 
        WHERE (name LIKE :name OR :name = '') 
        AND (surname LIKE :surname OR :surname = '') 
        AND role = 'user'";

    if ($active == 1) {
        $sql .= "AND deleted_at IS NULL ";
    }

    $stmt = $conn->prepare($sql);

    $name = "%$name%";
    $surname = "%$surname%";

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}



function delete_user($id)
{
    global $conn;

    // Kullanıcının silinme tarihini güncelle
    $sql = "UPDATE users SET deleted_at = NOW() WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function add_user($name, $surname, $username, $password, $role)
{

    global $conn;


    // Şifreyi hash'le
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

    $sql = "INSERT INTO users (role, name, surname, username, password) VALUES (:role, :name, :surname, :username, :password)";
    $stmt = $conn->prepare($sql);


    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    try {
        if ($stmt->execute()) {
            $_SESSION['message'] = "Kayıt başarıyla eklendi!";
            header('Location: ../musteri_ekle.php');
            exit;
        } else {
            $_SESSION['message'] = "Kayıt sırasında bir hata oluştu!";
            header('Location: ../musteri_ekle.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Bir hata oluştu: " . $e->getMessage();
        header('Location: ../musteri_ekle.php');
        exit;
    }
}

function get_username()
{

    global $conn;

    $sql = "SELECT id, username 
        FROM users WHERE role = 'firma' AND company_id IS NULL ";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}


?>