<?php
include('includes/header.php');
include('../functions/admin/company_function.php');
include('../config/dbcon.php');



$results = get_restaurant_detail();
?>

<div class="container">
    <div class="container mt-5">
        <h2 class="text-center">Firma-Restorant Paneli</h2>

        <div class="mt-5">
            <h3>Sonuçlar</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Firma Adı</th>
                        <th>Restorant Adı</th>
                        <th>Yemek</th>
                        <th>Açıklama</th>
                        <th>Fiyat</th>
                        <th>İndirim</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            echo "<tr>
                                    <td>{$row['company_name']}</td>
                                    <td>{$row['restaurant_name']}</td>
                                    <td>{$row['food_name']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['discount']}</td>
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