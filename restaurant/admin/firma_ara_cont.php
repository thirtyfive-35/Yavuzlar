<?php
include('includes/header.php');
//include('../middleware/adminMiddleware.php');
include('../functions/admin/company_function.php');
include('../config/dbcon.php');

$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
$active = isset($_GET['active']) && $_GET['active'] == '1';

// Arama yap
$results = search_company($name, $active);
?>

<div class="container">
    <div class="container mt-5">
        <h2 class="text-center">Firma Arama Paneli</h2>
        <form method="GET" action="firma_ara_cont.php" class="d-flex justify-content-center mt-4">
            <input type="text" name="name" class="form-control me-2" placeholder="Firma Adı" aria-label="Firma Adı" value="<?php echo $name; ?>">
            <div class="form-check me-2">
                <input type="checkbox" name="active" value="1" class="form-check-input" id="activeCompanies" <?php echo isset($_GET['active']) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="activeCompanies">Aktif Firmaları Göster</label>
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
        </form>

        <div class="mt-5">
            <h3>Arama Sonuçları</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firma Adı</th>
                        <th>Açıklama</th>
                        <th>Logo Yolu</th>
                        <th>firma sahibi id</th>
                        <th>firma sahibi username</th>
                        <th>Silinme Tarihi</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['logo_path']}</td>
                                    <td>{$row['id']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['deleted_at']}</td>
                                    <td>
                                        <a href='controller/delete_company.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Bu firmayı silmek istediğinize emin misiniz?\");'>Sil</a>
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
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info mt-3">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>

<?php include('includes/footer.php'); ?>