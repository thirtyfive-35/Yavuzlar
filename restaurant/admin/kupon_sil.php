<?php
include('includes/header.php');
include('../functions/admin/cupon_function.php');
include('../config/dbcon.php');

// Kuponları getir
$results = get_cupon();

?>

<div class="container">
    <div class="container mt-5">
        <h2 class="text-center">Kuponlar</h2>
        <div class="mt-5">
            <h3>Kupon Listesi</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kupon Kodu</th>
                        <th>Kupon Değeri</th>
                        <th>Restoran ID</th>
                        <th>Sil</th>
                        <th>Güncelle</th>
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
                                    <td>{$row['discount']}</td>
                                    <td>{$row['restaurant_id']}</td>
                                    <td>
                                        <a href='controller/delete_cupon.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Bu kuponu silmek istediğinize emin misiniz?\");'>Sil</a>
                                    </td>
                                    <td>
                                        <a href='kupon_guncelle.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Bu kuponu Güncellemek istediğinize emin misiniz?\");'>Güncelle</a>
                                    </td>
                                    <td>{$row['deleted_at']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Sonuç bulunamadı</td></tr>";
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