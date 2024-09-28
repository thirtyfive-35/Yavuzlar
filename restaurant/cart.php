<?php

include('functions/user/basket_function.php'); // Sepet fonksiyonlarını dahil et
include('config/dbcon.php');

session_start();
$user_id = $_SESSION['user_id'];
include('includes/header.php');

$cart_items = get_basket($user_id); // Sepet verilerini al
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="img/vegetable-item-3.png" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4"><?= htmlspecialchars($item['name']) ?></p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"><?= number_format($item['price'], 2) ?> $</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <form action="controller/basket/update_basket.php" method="POST" class="d-flex align-items-center">
                                        <input type="hidden" name="food_id" value="<?= htmlspecialchars($item['food_id']) ?>">
                                        <input type="hidden" name="restaurant_id" value="<?= htmlspecialchars($item['restaurant_id']) ?>">

                                        <!-- Azaltma Butonu -->
                                        <div class="input-group-btn me-2">
                                            <button type="submit" name="action" value="decrease" class="btn btn-sm btn-minus rounded-circle bg-light border" title="Miktarı azalt">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <!-- Miktar Göstergesi -->
                                        <input type="text" name="quantity" class="form-control form-control-sm text-center border-0" value="<?= htmlspecialchars($item['quantity']) ?>" readonly>

                                        <!-- Arttırma Butonu -->
                                        <div class="input-group-btn ms-2">
                                            <button type="submit" name="action" value="increase" class="btn btn-sm btn-plus rounded-circle bg-light border" title="Miktarı artır">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"><?= number_format($item['price'] * $item['quantity'], 2) ?> $</p>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <!-- Toplam Hesaplama -->
        <div class="row g-4 justify-content-end">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">$<?= number_format(array_sum(array_map(function ($item) {
                                                    return $item['price'] * $item['quantity'];
                                                }, $cart_items)), 2) ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <p class="mb-0">Flat rate: $3.00</p>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4">$<?= number_format(array_sum(array_map(function ($item) {
                                                    return $item['price'] * $item['quantity'];
                                                }, $cart_items)) + 3.00, 2) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->

<?php
include('includes/footer.php');
?>