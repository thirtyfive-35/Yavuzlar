
<?php

function GetQuest()
{

    include "db.php";

    $query = "SELECT * FROM Quest ";

    $statement = $pdo->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    return $result;
}

function AddQuest($quest, $answer)
{
    include "db.php";

    try {
        $query = "INSERT INTO Quest (quest, answer) VALUES (:quest, :answer)";

        $statement = $pdo->prepare($query);

        $statement->bindParam(':quest', $quest);
        $statement->bindParam(':answer', $answer);

        return $statement->execute();
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return false;
    }
}
function DeleteQuest($id)
{
    include "db.php";

    try {
        $query = "DELETE FROM Quest WHERE id = :id";

        $statement = $pdo->prepare($query);

        $statement->bindParam(':id', $id);

        return $statement->execute();
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return false;
    }
}

function UpdateQuest($id, $quest, $answer)
{
    include "db.php";

    try {
        $query = "UPDATE Quest SET quest = :quest, answer = :answer WHERE id = :id";

        $statement = $pdo->prepare($query);

        $statement->bindParam(':quest', $quest);
        $statement->bindParam(':answer', $answer);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return false;
    }
}



?>