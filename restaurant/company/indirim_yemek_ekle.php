<?php
include('includes/header.php');
include('../functions/company/restaurant_function.php');
include('../config/dbcon.php');

// Geçerli yemek ID'sini al
if (isset($_GET['id'])) {
    $food_id = intval($_GET['id']);
} else {
    // ID yoksa hata mesajı
    echo "Geçersiz yemek ID'si!";
    exit;
}
?>

<div class="container mt-5">
    <h2 class="text-center">Yemek Ekle</h2>

    <!-- Form -->
    <form action="controller/indirim_yemek.php" method="POST" enctype="multipart/form-data">
        <!-- Gizli alan -->
        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">

        <!-- İndirim miktarı -->
        <div class="mb-3">
            <label for="discount" class="form-label">İndirim miktarı</label>
            <textarea class="form-control" id="discount" name="discount" placeholder="İndirim miktarını girin" required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Kayıt Ekle</button>
        </div>
    </form>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info mt-3">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
