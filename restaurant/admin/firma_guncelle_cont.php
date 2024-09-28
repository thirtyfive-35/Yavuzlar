<?php
include('includes/header.php');
include('../functions/admin/user_function.php');
include('../functions/admin/company_function.php');
include('../config/dbcon.php');


$usernames = get_username(); // username ve id döndürmeli
$names = get_name_and_id();
?>

<div class="container mt-5">
    <h2 class="text-center">Firma Bilgisi Güncelle</h2>

    <!-- Form -->
    <form action="controller/update_company.php" method="POST" enctype="multipart/form-data">
        <div class="row">

            <!-- Company name-id Dropdown -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Firma adı Seç</label>
                <select class="form-control" id="firma_id" name="firma_id" required>
                    <option value="" disabled selected>Firma adı Seç</option>
                    <?php foreach ($names as $name): ?>
                        <option value="<?php echo $name['id']; ?>">
                            <?php echo $name['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Yeni Ad</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Adınızı girin" required>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Yeni Açıklama</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Açıklama girin" required></textarea>
        </div>

        <!-- Username Dropdown -->
        <div class="mb-3">
            <label for="user_id" class="form-label">Yeni Kullanıcı Seç</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="" disabled selected>Kullanıcı Seçin</option>
                <?php foreach ($usernames as $user): ?>
                    <option value="<?php echo $user['id']; ?>">
                        <?php echo $user['username']; ?>
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