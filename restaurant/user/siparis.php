<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../middleware/userMiddleware2.php');
include('../functions/user/order_function.php');
include('../config/dbcon.php');

// Mevcut oturumdan kullanıcı ID'sini alıyoruz
$user_id = $_SESSION['user_id'];

// Fonksiyon çağırılarak siparişler getiriliyor
$orders = getOrders($user_id);
include('includes/header.php');
?>

<div class="container">
    <div class="container mt-5">
        <h2 class="text-center">Siparişlerim</h2>

        <div class="mt-5">
            <h3>Sipariş Listesi</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sipariş ID</th>
                        <th>Durum</th>
                        <th>Toplam Fiyat</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Kullanıcı ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($orders) > 0) {
                        foreach ($orders as $order) {
                            echo "<tr>
                                    <td>{$order['id']}</td>
                                    <td>{$order['order_status']}</td>
                                    <td>{$order['total_price']}</td>
                                    <td>{$order['created_at']}</td>
                                    <td>{$order['user_id']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Sipariş bulunamadı</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
