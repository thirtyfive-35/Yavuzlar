<?php
include('includes/header.php');
include('config/dbcon.php');
include('functions/user/kupon_function.php');

// Verileri al
$coupons = get_restaurant_kupon();
?>

<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>


<div class="container mt-5" style="margin-top: 50px;">
    <h2 class="text-center">İndirim Uygulanan Restoranlar</h2>

    <!-- Tablo -->
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Kupon Kodu</th>
                    <th scope="col">İndirim Oranı</th>
                    <th scope="col">Restoran Adı</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <td><?php echo $coupon['company_name']; ?></td>
                    <td><?php echo number_format($coupon['discount_total'], 2); ?>%</td>
                    <td><?php echo $coupon['restaurant_name']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include('includes/footer.php'); ?>
