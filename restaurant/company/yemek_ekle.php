<?php
include('includes/header.php');
//include('../middleware/adminMiddleware.php');
include('../functions/admin/restaurant_function.php');
include('../config/dbcon.php');


$names=get_restaurant_name_and_id();
?>

<div class="container mt-5">
    <h2 class="text-center">Yemek Ekle</h2>

    <!-- Form -->
    <form action="controller/add_food.php" method="POST" enctype="multipart/form-data">
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

        <!-- Fiyat -->
        <div class="mb-3">
            <label for="fiyat" class="form-label">Fiyat</label>
            <textarea class="form-control" id="price" name="price"  placeholder="Fiyatı girin" required></textarea>
        </div>

        <!-- Name Dropdown -->
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restorant Seç</label>
            <select class="form-control" id="restaurant_id" name="restaurant_id" required>
                <option value="" disabled selected>Restorant Seçin</option>
                <?php foreach ($names as $name): ?>
                    <option value="<?php echo $name['id']; ?>">
                        <?php echo $name['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
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