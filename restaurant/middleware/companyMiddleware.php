<?php

include('../functions/redirect.php');

if (isset($_SESSION['auth'])) {

    if ($_SESSION['role'] != "firma") {
        redirect("../index.php", "you can not access that page");
    }
} else {
    redirect("../login.php", "Kullanıcı adı veya şifre yanlış!");
}


?>