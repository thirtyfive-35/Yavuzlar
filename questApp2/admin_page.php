<?php
session_start();

if ($_SESSION['is_admin'] !== 'admin') {
    header("Location: index.php?message=You are not authorized to view this page!");
    exit;
}

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login_page.php?message=You are not logged in!");
    exit();
} else {
?>



    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin Paneli</title>
        <link rel="stylesheet" href="styles.css"> <!-- İsteğe bağlı stil dosyası -->
    </head>

    <body>

        <!-- Çıkış Yap Düğmesi -->
        <form action="logout_controller.php" method="post">
            <button type="submit">Çıkış Yap</button>
        </form>

        <h1>Admin Paneli</h1>

        <!-- Soru Ekleme Formu -->
        <h2>Soru Ekle</h2>
        <form action="quest_add_controller.php" method="post">
            <label for="question_text">Soru Metni:</label>
            <input type="text" id="question_text" name="question_text" required>

            <label for="answer_text">Cevap Metni:</label>
            <input type="text" id="answer_text" name="answer_text" required>

            <button type="submit">Ekle</button>
        </form>


        <!-- Soru Güncelleme Formu -->
        <h2>Soru Güncelle</h2>
        <form action="quest_update_controller.php" method="post">
            <label for="question_id_update">Soru ID:</label>
            <input type="number" id="question_id_update" name="question_id_update" required>

            <label for="new_question_text">Yeni Soru Metni:</label>
            <input type="text" id="new_question_text" name="new_question_text" required>

            <label for="new_answer_text">Yeni Soru Cevabu:</label>
            <input type="text" id="new_answer_text" name="new_answer_text" required>

            <button type="submit">Güncelle</button>
        </form>

        <!-- Soru Silme Formu -->
        <h2>Soru Sil</h2>
        <form action="quest_delete_controller.php" method="post">
            <label for="question_id_delete">Soru ID:</label>
            <input type="number" id="question_id_delete" name="question_id_delete" required>
            <button type="submit">Sil</button>
        </form>

        <!-- Soruları Listeleme -->
        <h2>Soruları Listele</h2>
        <?php
        include 'functions/questFunctions.php';
        $questions = GetQuest();

        if (count($questions) > 0) {
            echo '<ul>';
            foreach ($questions as $question) {
                echo '<li>';
                echo "id: " . htmlspecialchars($question['id']) . " soru: " . htmlspecialchars($question['quest']) . " cevap: " . htmlspecialchars($question['answer']);
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Listeleyecek soru yok.</p>';
        }
        ?>
    </body>

    </html>

<?php } ?>