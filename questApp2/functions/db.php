<?php

try {
    $pdo = new PDO("sqlite:db/data.db");

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    echo "Hata " . $th;
}
