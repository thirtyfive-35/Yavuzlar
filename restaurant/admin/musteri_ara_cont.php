<?php
include('includes/header.php');
//include('../middleware/adminMiddleware.php');
include('../functions/admin/user_function.php');
include('../config/dbcon.php');


$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
$surname = isset($_GET['surname']) ? htmlspecialchars($_GET['surname']) : '';
$active = isset($_GET['active']) && $_GET['active'] == '1';


// Arama yap
$results = search_user($name, $surname, $active);
?>

<div class="container">
    <div class="container mt-5">
        <h2 class="text-center">Müşteri Arama Paneli</h2>
        <form method="GET" action="musteri_cont.php" class="d-flex justify-content-center mt-4">
            <input type="text" name="name" class="form-control me-2" placeholder="Ad" aria-label="Ad" value="<?php echo $name; ?>">
            <input type="text" name="surname" class="form-control me-2" placeholder="Soyad" aria-label="Soyad" value="<?php echo $surname; ?>">
            <div class="form-check me-2">
                <input type="checkbox" name="active" value="1" class="form-check-input" id="activeUsers" <?php echo isset($_GET['active']) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="activeUsers">Aktif Kullanıcıları Göster</label>
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
        </form>

        <div class="mt-5">
            <h3>Arama Sonuçları</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Kullanıcı Adı</th>
                        <th>Bakiye</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Silinme Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['surname']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['balance']}</td>
                                    <td>{$row['created_at']}</td>
                                    <td>{$row['deleted_at']}</td>
                                    <td>
                                        <a href='controller/delete_user.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Bu müşteriyi silmek istediğinize emin misiniz?\");'>Sil</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Sonuç bulunamadı</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>