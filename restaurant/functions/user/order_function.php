<?php

function get_basket_info($user_id)
{
    global $conn;
    // Total price hesaplaması için doğru bir SQL sorgusu
    $sql = "SELECT b.food_id, b.quantity, f.price, (f.price * b.quantity) AS total_price 
            FROM basket b 
            INNER JOIN food f ON b.food_id = f.id 
            WHERE b.user_id = :user_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function calculate_total_price($user_id)
{
    $items = get_basket_info($user_id);

    // Total price değerlerini almak için array_column kullan
    $total_prices = array_column($items, 'total_price');

    // Toplam fiyatı hesapla
    $total = array_sum($total_prices);

    // Her bir öğeyi döndür
    return [
        'total' => $total,
        'items' => $items // Orijinal öğeleri döndür
    ];
}

function order($user_id, $note = null)
{
    global $conn;

    // Kullanıcının bakiyesini al
    $get_balance_sql = "SELECT balance FROM users WHERE id = :user_id";
    $get_balance = $conn->prepare($get_balance_sql);
    $get_balance->bindParam(':user_id', $user_id);
    $get_balance->execute();
    $user_balance = $get_balance->fetch(PDO::FETCH_ASSOC)['balance']; // balance değerini al

    // Sepetteki toplam fiyatı hesapla
    $result = calculate_total_price($user_id);
    $total_price = $result['total'];

    // Bakiyenin yeterli olup olmadığını kontrol et
    if ($user_balance >= $total_price) {
        $order_status = "hazırlanıyor";

        // Siparişi ekle
        $add_order_sql = "INSERT INTO orders (user_id, order_status, total_price) VALUES (:user_id, :order_status, :total_price)";
        $add_order = $conn->prepare($add_order_sql);
        $add_order->bindParam(':user_id', $user_id);
        $add_order->bindParam(':order_status', $order_status);
        $add_order->bindParam(':total_price', $total_price);

        // Sipariş ekleme işlemi
        $is_okey = $add_order->execute();

        // En son eklenen siparişin ID'sini al
        $lastOrderId = $conn->lastInsertId();

        if ($is_okey) {
            // Kullanıcının bakiyesini güncelle
            $new_balance = $user_balance - $total_price;
            $sql = "UPDATE users SET balance = :user_balance WHERE id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_balance', $new_balance);
            $stmt->bindParam(':user_id', $user_id);

            if ($stmt->execute()) {
                // Sepetteki ürünleri sipariş öğelerine ekle
                foreach ($result['items'] as $item) {
                    $sql_order_items = "INSERT INTO order_items (food_id, order_id, quantity, price) VALUES (:food_id, :order_id, :quantity, :price)";
                    $stmt_order_items = $conn->prepare($sql_order_items);
                    $stmt_order_items->bindParam(':food_id', $item['food_id']);
                    $stmt_order_items->bindParam(':order_id', $lastOrderId);
                    $stmt_order_items->bindParam(':quantity', $item['quantity']);
                    $stmt_order_items->bindParam(':price', $item['price']); // Birim fiyatı kullan

                    // Sipariş öğelerini ekle
                    if (!$stmt_order_items->execute()) {
                        return false; // Eğer bir sipariş öğesi eklenemedi ise işlemi iptal et
                    }
                }

                // Sepet verilerini sil
                $delete_basket_sql = "DELETE FROM basket WHERE user_id = :user_id";
                $delete_basket_stmt = $conn->prepare($delete_basket_sql);
                $delete_basket_stmt->bindParam(':user_id', $user_id);

                if (!$delete_basket_stmt->execute()) {
                    return false; // Sepet silinemedi
                }
                return true; // Tüm işlemler başarılı ise true döndür
            } else {
                return false; // Bakiye güncellenemedi
            }
        } else {
            return false; // Sipariş eklenemedi
        }
    } else {
        return false; // Yetersiz bakiye
    }
}




?>