
<?php
function GetAllQuestions($user_id)
{
    include "db.php";

    try {
        // SQL sorgusu, belirtilen kullanıcı tarafından doğru cevaplanan soruları hariç tutar
        $query = "
            SELECT q.*
            FROM Quest q
            LEFT JOIN Submissions s ON q.id = s.question_id AND s.user_id = :user_id AND s.is_correct = 1
            WHERE s.question_id IS NULL
        ";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return [];
    }
}



function  GetCorrectAnswer($id)
{
    include "db.php";

    try {
        $query = "SELECT answer FROM Quest WHERE id = :id";
        $statement = $pdo->prepare($query);

        $statement->bindParam(':id', $id);

        $statement->execute();

        return $statement->fetchColumn();
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return [];
    }
}

function AddScore($user_id, $question_id, $is_correct = true)
{
    include "db.php";

    try {
        $query = "INSERT INTO Submissions (user_id, question_id, is_correct, score) VALUES (:user_id, :question_id, :is_correct, :score)";
        $statement = $pdo->prepare($query);

        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':question_id', $question_id);
        $statement->bindParam(':is_correct', $is_correct, PDO::PARAM_BOOL);
        $score = 10;
        $statement->bindParam(':score', $score, PDO::PARAM_INT);

        $statement->execute();

        return $statement->rowCount() > 0;
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return false;
    }
}

function GetAllUserScores()
{
    include "db.php";

    try {
        $query = "
            SELECT u.username, SUM(s.score) as total_score
            FROM User u
            JOIN Submissions s ON u.id = s.user_id
            WHERE s.is_correct = 1
            GROUP BY u.id
            ORDER BY total_score DESC
        ";
        $statement = $pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
        return [];
    }
}





?>