<?php
include('includes/header.php');
include('../functions/company/food_function.php');
include('../config/dbcon.php');


$names = get_restaurant_name_and_id();
$names2 =get_food_name_and_id()
?>

<div class="container mt-5">
    <h2 class="text-center">Yemek Bilgisi Güncelle</h2>

    <!-- Form -->
    <form action="controller/update_food.php" method="POST" enctype="multipart/form-data">
        <div class="row">

            <!-- Restaurant name-id Dropdown -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Restorant adı Seç</label>
                <select class="form-control" id="restaurant_id" name="restaurant_id" required>
                    <option value="" disabled selected>Restorant adı Seç</option>
                    <?php foreach ($names as $name): ?>
                        <option value="<?php echo $name['id']; ?>">
                            <?php echo $name['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Food name-id Dropdown -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Yemek adı Seç</label>
                <select class="form-control" id="id" name="id" required>
                    <option value="" disabled selected>Yemek adı Seç</option>
                    <?php foreach ($names2 as $name2): ?>
                        <option value="<?php echo $name2['id']; ?>">
                            <?php echo $name2['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Yeni Yemek Ad</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Yemek adı girin" required>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Yeni Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Açıklama girin" required></textarea>
        </div>

        <!-- Price -->
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Yeni Fiyat</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Fiyatı girin" required>
            </div>
        </div>

        

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Yemek Ekle</button>
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