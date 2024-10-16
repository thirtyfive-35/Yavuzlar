<?php
include('includes/header.php');
include('../functions/admin/cupon_function.php');
include('../functions/admin/restaurant_function.php');
include('../config/dbcon.php');

$names = get_restaurant_name_and_id(); // restaurant adlarını ve id'lerini döndürmeli

$kupon_id = $_GET['id'];
?>

<div class="container mt-5">
    <h2 class="text-center">Kupon Güncelle</h2>

    <!-- Form -->
    <form action="controller/update_kupon.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Kupon ID (Gizli Alan) -->
            <input type="hidden" name="kupon_id" value="<?php echo $kupon_id; ?>">

            <!-- Kupon Kodu -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Kupon kodu girin</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Kupon Kodu" required>
            </div>
        </div>

        <!-- Kupon Değeri -->
        <div class="mb-3">
            <label for="discount" class="form-label">Kupon değeri</label>
            <textarea class="form-control" id="discount" name="discount" rows="3" placeholder="Kupon değeri girin" required></textarea>
        </div>

        <!-- Restoran Seçim Dropdown -->
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restoran Seç</label>
            <select class="form-control" id="restaurant_id" name="restaurant_id" required>
                <option value="" disabled selected>Restoran Seç</option>
                <?php foreach ($names as $restaurant): ?>
                    <option value="<?php echo $restaurant['id']; ?>">
                        <?php echo $restaurant['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Güncelle</button>
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
