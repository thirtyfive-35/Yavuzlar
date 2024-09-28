<?php
include('includes/header.php');
//include('../middleware/adminMiddleware.php');
?>

<div class="container mt-5">
    <h2 class="text-center">Yeni Kullanıcı Oluştur</h2>

    <!-- Kullanıcı Oluşturma Formu -->
    <form action="controller/add_user.php" method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Ad</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Adınızı girin" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="surname" class="form-label">Soyad</label>
                <input type="text" class="form-control form-control-sm" id="surname" name="surname" placeholder="Soyadınızı girin" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Kullanıcı Adı</label>
            <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Kullanıcı adınızı girin" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Şifrenizi girin" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-control form-control-sm" id="role" name="role" required>
                <option value="" disabled selected>Rol Seçin</option>
                <option value="user">Kullanıcı</option>
                <option value="firma">Firma</option>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Kullanıcı Oluştur</button>
        </div>
    </form>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info mt-3">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Mesajı bir kez gösterdikten sonra kaldır
            ?>
        </div>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>