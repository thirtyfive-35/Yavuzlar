<?php

include('functions/user/restaurant_function.php');
include('config/dbcon.php');
session_start();
include('middleware/userMiddleware.php');
include('includes/header.php');

$restaurants = get_restaurant_info(); // username ve id döndürmeli
?>


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Restoranlar</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
        <li class="breadcrumb-item"><a href="#">Sayfalar</a></li>
        <li class="breadcrumb-item active text-white">Restoranlar</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Restoranlar Başlangıç-->
<div class="container-fluid restaurant py-5">
    <div class="container py-5">
        <h1 class="mb-4">Restoranlar</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="Restoran adı ara" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="restaurants">Sıralama:</label>
                            <select id="restaurants" name="restaurantlist" class="border-0 form-select-sm bg-light me-3" form="restaurantform">
                                <option value="default">Varsayılan</option>
                                <option value="popularity">Popülerlik</option>
                                <option value="rating">Puan</option>
                                <option value="discount">İndirim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Kategoriler</h4>
                                    <ul class="list-unstyled restaurant-categories">
                                        <li>
                                            <div class="d-flex justify-content-between category-name">
                                                <a href="#"><i class="fas fa-utensils me-2"></i>Türk Mutfağı</a>
                                                <span>(10)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between category-name">
                                                <a href="#"><i class="fas fa-utensils me-2"></i>İtalyan Mutfağı</a>
                                                <span>(5)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between category-name">
                                                <a href="#"><i class="fas fa-utensils me-2"></i>Japon Mutfağı</a>
                                                <span>(7)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between category-name">
                                                <a href="#"><i class="fas fa-utensils me-2"></i>Fast Food</a>
                                                <span>(15)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Fiyat Aralığı</h4>
                                    <input type="range" class="form-range w-100" id="priceRange" name="priceRange" min="0" max="1000" value="0" oninput="priceOutput.value=priceRange.value">
                                    <output id="priceOutput" name="priceOutput" min-value="0" max-value="1000" for="priceRange">0</output>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?php

                            foreach ($restaurants as $restaurant) {
                                echo '<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative restaurant-item">
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <img src="images/images.png" alt="Image description" class="img-fluid">
                                            <h4>' . $restaurant['name'] . '</h4>
                                            <p>' . $restaurant['description'] . '</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">' . "50-200" . '</p>
                                                <p class="text-dark">Puan: ' . "4.5" . '</p>
                                                <a href="restaurant_goruntule.php?id=' . $restaurant['id'] . '" target="_blank" class="btn border border-secondary rounded-pill px-3 text-primary">İncele</a>
                                            </div>
                                            <p class="text-success">' . "150 tl" . ' indirim</p>
                                        </div>
                                    </div>
                                </div>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Restoranlar Bitiş-->


<?php include('includes/footer.php'); ?>