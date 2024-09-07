<?php
session_start();
include "functions/questUserFunctions.php";

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login_page.php?message=You are not logged in!");
    exit();
}

$student_id = $_SESSION['id'];

// Tüm soruları al
$questions = GetAllQuestions($student_id);

// Oturumda mevcut soru ID'si varsa al, yoksa ilk sorudan başla
$current_question_id = isset($_SESSION['current_question_id']) ? $_SESSION['current_question_id'] : null;

if (count($questions) > 0) {
    if ($current_question_id === null) {
        // İlk soruyu al
        $question = $questions[0];
        $_SESSION['current_question_id'] = $question['id'];
    } else {
        // Mevcut soru ID'sine göre sıradaki soruyu al
        $found = false;
        foreach ($questions as $q) {
            if ($q['id'] == $current_question_id) {
                $question = $q;
                $found = true;
                break;
            }
        }

        // Eğer mevcut soru bulunamadıysa, bir sonraki soruya geç
        if (!$found) {
            $question = $questions[0];
            $_SESSION['current_question_id'] = $question['id'];
        }
    }

    // Çıkış Yap Düğmesi
    echo '<form action="logout_controller.php" method="post">';
    echo '<button type="submit">Çıkış Yap</button>';
    echo '</form>';
    // Skor Tablosu Butonu
    echo '<form action="scoreboard.php" method="get">';
    echo '<button type="submit">Skor Tablosu</button>';
    echo '</form>';

    echo "<h2>Soru: " . htmlspecialchars($question['quest']) . "</h2>";

    // Cevap formu
    echo '<form action="submit_answer.php" method="post">';
    echo '<input type="hidden" name="question_id" value="' . htmlspecialchars($question['id']) . '">';
    echo '<label for="answer">Cevap:</label>';
    echo '<input type="text" id="answer" name="answer" required>';
    echo '<button type="submit">Cevapla</button>';
    echo '</form>';
} else {
    echo "<p>Görüntülenecek soru yok.</p>";
}
