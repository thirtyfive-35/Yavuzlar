<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('middleware/userMiddleware.php');
include('includes/header.php');
include('functions/user/food_function.php');
include('config/dbcon.php');


$test = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $restaurant_id = $_GET['id'];
    $products = get_food_detail($restaurant_id);
    $comments = get_comments($restaurant_id);
} else {
    header("Location: shop.php");
    exit();
}



?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop Detail </h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <h4 class="mb-4">Ürünler </h4>
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-info mt-3">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    // Restorandan alınan ürün bilgileri

                    foreach ($products as $product): ?>
                        <div class="col-lg-12 mb-3">
                            <div class="border rounded p-3">
                                <h5 class="fw-bold mb-2"><?= $product['name'] ?></h5>
                                <h5 class="fw-bold mb-3"><?= $product['price'] ?></h5>
                                <p class="mb-4"><?= $product['description'] ?></p>
                                <!-- Sepete ekleme formu -->
                                <form action="controller/basket/add_basket.php" method="POST">
                                    <input type="hidden" name="restaurant_id" value="<?= $restaurant_id ?>" />
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>" />
                                    <button type="submit" name="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">Sepete Ekle</button>
                                </form>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-lg-12 mt-5">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                aria-controls="nav-about" aria-selected="true">Description</button>
                            <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                aria-controls="nav-mission" aria-selected="false">Reviews</button>
                        </div>
                    </nav>
                    <div class="tab-content mb-5">
                        <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                            <p><?= $product['description'] ?></p>
                        </div>
                        <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                            <!-- Yorumlar kısmını burada dinamik olarak gösterebilirsiniz -->
                            <?php if (!empty($comments)): ?>
                                <?php foreach ($comments as $comment): ?>
                                    <div class="d-flex mb-4">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;"><?= date('F d, Y', strtotime($comment['created_at'])); ?></p>
                                            <div class="d-flex justify-content-between">
                                                <h5><?= htmlspecialchars($comment['surname']); ?></h5>
                                                <div class="d-flex mb-3">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fa fa-star <?= $i <= $comment['score'] ? 'text-secondary' : ''; ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <h6><?= htmlspecialchars($comment['title']); ?></h6>
                                            <p><?= htmlspecialchars($comment['description']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No reviews yet. Be the first to leave a review!</p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <form action="controller/food/add_comment.php" method="POST">
                    <input type="hidden" name="restaurant_id" value="<?= $restaurant_id; ?>" /> <!-- Restaurant ID'sini gizli input ile alıyoruz -->
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border-bottom rounded">
                                <input type="text" class="form-control border-0 me-4" name="surname" placeholder="Your Surname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="border-bottom rounded">
                                <input type="text" class="form-control border-0" name="title" placeholder="Your Title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border-bottom rounded">
                                <textarea class="form-control border-0" name="description" rows="5" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border-bottom rounded">
                                <input type="number" class="form-control border-0" name="score" min="1" max="5" placeholder="Score (1-5)">
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="submit">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="bg-light rounded p-4 mb-4">
                    <h4 class="fw-bold mb-4">Related Products</h4>
                    <div class="d-flex mb-3">
                        <img src="img/related-1.jpg" style="width: 80px; height: 80px;" alt="">
                        <div class="ps-3">
                            <h6 class="mb-1">Product Name</h6>
                            <small class="text-body">Price</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <img src="img/related-2.jpg" style="width: 80px; height: 80px;" alt="">
                        <div class="ps-3">
                            <h6 class="mb-1">Product Name</h6>
                            <small class="text-body">Price</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <img src="img/related-3.jpg" style="width: 80px; height: 80px;" alt="">
                        <div class="ps-3">
                            <h6 class="mb-1">Product Name</h6>
                            <small class="text-body">Price</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <img src="img/related-4.jpg" style="width: 80px; height: 80px;" alt="">
                        <div class="ps-3">
                            <h6 class="mb-1">Product Name</h6>
                            <small class="text-body">Price</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->

<?php include('includes/footer.php') ?>