<?php

function getUserById($userId) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

function getProfilePhoto($userId) {
    global $conn;
    $sql = "SELECT photo_path FROM user_profile_photos WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

function updateUserProfile($userId, $name, $surname, $username) {
    global $conn;
    $sql = "UPDATE users SET name = ?, surname = ?, username = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$name, $surname, $username, $userId]);
}

function addUserBalance($userId, $amount) {
    global $conn;
    $sql = "UPDATE users SET balance = balance + ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$amount, $userId]);
}

function changeUserPassword($userId, $currentPassword, $newPassword) {
    global $conn;
    $user = getUserById($userId);
    if (password_verify($currentPassword, $user['password'])) {
        $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$hashedPassword, $userId]);
    }
    return false;
}



?>