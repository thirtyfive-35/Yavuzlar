-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Eki 2024, 03:11:51
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `restaurant-web-app`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `score` decimal(3,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `restaurant_id`, `surname`, `title`, `description`, `score`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'oktay', 'Bayıldım Çok iyi ', 'Köftesi Mükkemmel. Tam istediğim gibi fiyatı da aşırı ucuz.', 4.00, '2024-09-28 12:34:46', '2024-09-28 12:34:46'),
(2, 3, 1, 'oktay', 'Çok kötü', 'Köftesi Mükkemmel. Tam istediğim gibi fiyatı da aşırı ucuz.2', 2.00, '2024-09-28 12:36:17', '2024-09-28 12:36:17'),
(4, 3, 1, 'asdas', 'asd', 'dasd', 3.00, '2024-09-28 12:37:55', '2024-09-28 12:37:55'),
(6, NULL, 1, 'baturay', 'test etst', 'test35', 4.00, '2024-09-28 15:30:08', '2024-09-28 15:30:08'),
(7, 3, 1, 'test33535', 'test3535', 'test test ', 4.00, '2024-09-28 15:52:09', '2024-09-28 15:52:09'),
(8, 3, 1, 'sondeneme', 'sondemene', 'asdasd', 5.00, '2024-10-01 22:23:38', '2024-10-01 22:23:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`id`, `name`, `description`, `logo_path`, `deleted_at`) VALUES
(1, 'köfteci yusfu', 'dünyanın en kötü köftesi', '', NULL),
(2, 'köfteci alperen', 'test-1', NULL, '2024-09-26 15:01:30'),
(3, 'öncü dürüm', 'bayılırım ', '', NULL),
(4, 'sezen inşaat ', 'sezen hayrimenkul', '', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cupon`
--

CREATE TABLE `cupon` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cupon`
--

INSERT INTO `cupon` (`id`, `restaurant_id`, `name`, `discount`, `created_at`, `deleted_at`) VALUES
(1, 1, 'SEZEN35', 99.00, '2024-09-26 17:41:57', '2024-09-26 21:12:43'),
(2, 1, 'BATURAY35', 5.00, '2024-09-26 17:56:49', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `food`
--

INSERT INTO `food` (`id`, `restaurant_id`, `name`, `description`, `image_path`, `price`, `discount`, `created_at`, `deleted_at`) VALUES
(1, 1, 'hamburger-köfte', 'aşırı leziz olmayan hamburger', NULL, 150.00, NULL, '2024-09-26 14:44:39', NULL),
(2, 2, 'hatay üsülü 80 gr', 'hatay üsülü 80 gr tavuk , çiçek', NULL, 100.00, NULL, '2024-09-28 14:36:43', NULL),
(3, 2, 'hatay üsülü menü ', 'patates, dürüm , kola', NULL, 200.00, NULL, '2024-09-28 14:37:24', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `order_status`, `total_price`, `created_at`, `user_id`) VALUES
(1, 'hazırlanıyor', 1300.00, '2024-10-01 01:27:31', 3),
(2, 'hazırlanıyor', 400.00, '2024-10-01 01:39:07', 3),
(3, 'hazırlanıyor', 750.00, '2024-10-01 22:27:22', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `food_id`, `order_id`, `quantity`, `price`) VALUES
(1, 1, 1, 4, 150.00),
(2, 2, 1, 7, 100.00),
(3, 2, 2, 2, 100.00),
(4, 3, 2, 1, 200.00),
(5, 1, 3, 5, 150.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant`
--

INSERT INTO `restaurant` (`id`, `company_id`, `name`, `description`, `image_path`, `created_at`) VALUES
(1, 1, 'köfteci yusuf turgutlu', 'çok kötü köfte', NULL, '2024-09-26 14:36:42'),
(2, 3, 'öncü dürüm - izmir', 'hayat üsülü dürüm', NULL, '2024-09-28 14:34:57');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT 5000.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `company_id`, `role`, `name`, `surname`, `username`, `password`, `balance`, `created_at`, `deleted_at`) VALUES
(2, NULL, 'admin', 'baturay', 'incekara', 'baturay35', '$argon2id$v=19$m=65536,t=4,p=1$YnZKSkZVYnFHTmNxU2dDSw$alSmHD0c6GYMmLkeuwhLwbQD4ifXmOrdMooyzSxttvg', 5000.00, '2024-09-19 21:43:27', NULL),
(3, NULL, 'user', 'sezen melis', 'oktay', 'sezen35', '$argon2id$v=19$m=65536,t=4,p=1$bGxoSlRSV1doT0xyYUlBNA$YoDegqA86Sel7A9Auq1QdeP1g/gTWEOez4OMlIDgWx4', 2550.00, '2024-09-19 21:46:23', '2024-09-24 23:04:53'),
(4, 2, 'firma', 'baturay', 'incekara', 'baturay12', '$argon2id$v=19$m=65536,t=4,p=1$NlQyaXRnV2cwaUwzdkF0bQ$ymcQv+DurthT/o5OjsiDOV+bVZClzVMhywZzIZ+cZxU', 5000.00, '2024-09-19 22:56:56', NULL),
(5, 1, 'firma', 'yusuf', 'köfteci', 'köfteci35', '$argon2id$v=19$m=65536,t=4,p=1$bE8xR2tEdXhxV3kuYUhvWA$Zk3A8wdyBOHJ43YEdKKTG1SaNgfE0R05gTi+caEXnS0', 5000.00, '2024-09-19 23:25:55', NULL),
(6, NULL, 'user', 'baturay', 'ince', 'baturay3535', '$argon2id$v=19$m=65536,t=4,p=1$alRpaVE4S3RraVFpT0IvVg$plAKsNubSbN0Sbfgv5YaUMmKdSu2oe/uwas/EGoGFHQ', 5000.00, '2024-09-24 21:21:51', NULL),
(7, NULL, 'firma', 'alperen', 'yılmaz', 'alperen35', '$argon2id$v=19$m=65536,t=4,p=1$eGNqWWdVM1B6OVVNaURQVQ$OA6OlzMHl7zY0rvE7+5kfLHNp/cpGJOTNSd8WaZ7Dcw', 5000.00, '2024-09-25 21:00:16', NULL),
(8, NULL, 'user', 'alperen', 'yil', 'elir', '$argon2id$v=19$m=65536,t=4,p=1$Mkw2ZnRsMmpRZGVLL3VoLg$xnUG84TzRzKs4e3U1+NmTZ85RSZ8U1Ej2aQZeVMKKN0', 5000.00, '2024-09-25 21:01:59', NULL),
(9, 3, 'firma', 'ronay', 'öktem', 'ron', '$argon2id$v=19$m=65536,t=4,p=1$Z2Y5aXhBN2x0VlpJdEMwUQ$2V9NYPmWrb5Na0/meG8lVrRRzZuvp8ov47ibW79mE7c', 5000.00, '2024-09-25 23:09:10', NULL),
(10, NULL, 'firma', 'sezomelo', 'oktay', 'sezo35', '$argon2id$v=19$m=65536,t=4,p=1$N1NUSmdmYlowVjNYUEtxZQ$xdeL1/ppng5blLkZpazYUtrwU8+8rUNLJ9BBTMTgg4I', 5000.00, '2024-09-26 15:08:38', NULL),
(11, 4, 'firma', 'sez12', 'sez12', 'sez123', '$argon2id$v=19$m=65536,t=4,p=1$aTczRGRwS2RJLi43cjBmag$u/1lepVaLge4fpWL/Wrmf25b877FWqC88xJeA16pkpY', 5000.00, '2024-09-26 15:10:29', NULL),
(12, NULL, 'firma', 'alperen', '123sa', 'seasd123', '$argon2id$v=19$m=65536,t=4,p=1$aUwxbWh2eVM5Z1pmRnEvUg$wHY8P2YrIq8hmsUnY2C55SPPQFjwWkrFWlnQ2b5ngfY', 5000.00, '2024-09-26 15:11:42', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Tablo için indeksler `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `cupon`
--
ALTER TABLE `cupon`
  ADD CONSTRAINT `cupon_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Tablo kısıtlamaları `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
