<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
            <span class="ms-1 font-weight-bold text-white">Kullanıcı Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Müşteri Yönetimi -->
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#customerManagement" role="button" aria-expanded="false" aria-controls="customerManagement">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1">Kullanıcı Yönetimi</span>
                </a>
                <div class="collapse" id="customerManagement">
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="customer_profile.php">
                                <span class="nav-link-text ms-1">Müşteri Genel İşlemler</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="change_password.php">
                                <span class="nav-link-text ms-1">Şifre İşlemlerİ</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="siparis.php">
                                <span class="nav-link-text ms-1">Siparişler</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="../index.php" type="button">Anasayfa</a>
        </div>
    </div>
</aside>