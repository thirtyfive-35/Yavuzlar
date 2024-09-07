
<?php
session_start();
include "functions/questFunctions.php";

if ($_SESSION['is_admin'] !== 'admin') {
    header("Location: index.php?message=You are not authorized to view this page!");
    exit;
}

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login.php?message=You are not logged in!");
    exit;
}

if (isset($_POST['question_id_update'])) {
    $id = htmlspecialchars($_POST['question_id_update']);
    $quest = htmlspecialchars($_POST['new_question_text']);
    $answer = htmlspecialchars($_POST['new_answer_text']);

    $result = UpdateQuest($id, $quest, $answer);
    print_r($result);
    header("Location: admin_page.php");
}
?>
