<?php
include('includes/header.php');
include('../functions/company/restaurant_function.php');
include('../config/dbcon.php');

?>

<div class="container mt-5">
    <h2 class="text-center">Restaurant Ekle</h2>

    <!-- Form -->
    <form action="controller/add_restaurant.php" method="POST" enctype="multipart/form-data">
        <div class="row">

            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Ad</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Adınızı girin" required>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="1" placeholder="Açıklama girin" required></textarea>
        </div>

        <!-- Dosya Yükleme -->
        <div class="mb-3">
            <label for="food_image" class="form-label">Yemek Görseli Yükle</label>
            <input type="file" class="form-control" id="food_image" name="food_image" required>
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
