<?php
session_start();
include "functions/questUserFunctions.php";


$student_id = $_SESSION['id'];
$question_id = $_POST['question_id'];
$answer = htmlspecialchars($_POST['answer']);


// Sorunun doğru cevabını al
$correct_answer = GetCorrectAnswer($question_id);

print_r($answer);
print_r($correct_answer);
if ($answer === $correct_answer) {
    // Puan ekleme
    AddScore($student_id, $question_id);

    // Sonuç mesajı
    echo "Tebrikler, doğru cevap verdiniz! Puanınız arttı.";
} else {
    echo "Maalesef, cevabınız yanlış.";
}

// Bir sonraki soruyu al
$questions = GetAllQuestions($student_id);
$found_current = false;
$next_question = null;

foreach ($questions as $q) {
    if ($q['id'] == $question_id) {
        $found_current = true;
    } elseif ($found_current) {
        $next_question = $q;
        break;
    }
}

// Eğer bir sonraki soru varsa, o soruya geç
if ($next_question) {
    $_SESSION['current_question_id'] = $next_question['id'];
} else {
    // Eğer tüm sorular çözüldüyse oturumu temizle
    unset($_SESSION['current_question_id']);
}

// Soruları yeniden gösterme sayfasına yönlendir
header("Location: user_page.php");
exit;
