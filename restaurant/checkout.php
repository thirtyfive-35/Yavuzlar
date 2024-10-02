<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('middleware/userMiddleware.php');

include('includes/header.php');
include('functions/user/basket_function.php'); // Sepet fonksiyonlarını dahil et
include('config/dbcon.php');


$user_id = $_SESSION['user_id'];


$cart_items = get_basket($user_id); // Sepet verilerini al
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info mt-3">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <h1 class="mb-4">Billing details</h1>
        <form action="controller/basket/order_accept.php" method="POST">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="House Number Street Name" />
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control" />
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control" />
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control" />
                    </div>
                    <hr />
                    <div class="form-item">
                        <textarea
                            name="note"
                            class="form-control"
                            spellcheck="false"
                            cols="30"
                            rows="11"
                            placeholder="Oreder Notes (Optional)"></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
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
                                <?php foreach ($cart_items as $index => $item): ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="img/vegetable-item-3.png" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="Product Image">
                                            </div>
                                        </th>
                                        <td>
                                            <p class="mb-0 mt-4"><?= htmlspecialchars($item['name']) ?></p>
                                        </td>
                                        <td>
                                            <p class="mb-0 mt-4"><?= number_format($item['price'], 2) ?> $</p>
                                        </td>
                                        <td>
                                            <!-- Her ürün için ayrı bir form ve benzersiz form ID'si -->
                                            <div class="input-group quantity mt-4" style="width: 100px;">


                                                <!-- Miktar Göstergesi -->
                                                <p class="mb-0 mt-6"><?= htmlspecialchars($item['quantity']) ?></p>

                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 mt-4"><?= number_format($item['price'] * $item['quantity'], 2) ?> $</p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 pe-4">$<?= number_format(array_sum(array_map(function ($item) {
                                                                        return $item['price'] * $item['quantity'];
                                                                    }, $cart_items)) + 3.00, 2) ?></p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input
                                    type="checkbox"
                                    class="form-check-input bg-primary border-0"
                                    id="Transfer-1"
                                    name="Transfer"
                                    value="Transfer" />
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">
                                Make your payment directly into our bank account. Please use
                                your Order ID as the payment reference. Your order will not be
                                shipped until the funds have cleared in our account.
                            </p>
                        </div>
                    </div>
                    <div
                        class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-success py-3 px-4 text-uppercase w-100">
                            Siparişi Öde
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->




<?php include('includes/footer.php'); ?>