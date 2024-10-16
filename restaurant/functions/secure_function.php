<?php

function secureFileUpload($file, $target_dir, $allowed_types = ['jpg', 'jpeg', 'png', 'gif'])
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => "File Upload Error!"];
    }

    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_types)) {
        return ['status' => false, 'message' => "Invalid file type!"];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    $allowed_types = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif'
    ];

    if (!array_key_exists($mime, $allowed_types)) {
        return ['status' => false, 'message' => "Invalid MIME Type!"];
    }

    $magic_bytes = [
        'jpg' => "\xFF\xD8\xFF",
        'jpeg' => "\xFF\xD8\xFF",
        'png' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A",
        'gif' => "GIF"
    ];

    $fh = fopen($file['tmp_name'], 'rb');
    $bytes = fread($fh, 8);
    fclose($fh);

    if (strpos($bytes, $magic_bytes[$file_ext]) !== 0) {
        return ['status' => false, 'message' => "File failed magic byte check!"];
    }

    $random_number = rand(1, 1000);
    $new_filename = $random_number . '_' . basename($file['name']);
    $target_file = $target_dir . $new_filename;

    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        return ['status' => false, 'message' => "Error moving the uploaded file!"];
    }

    return ['status' => true, 'filename' => $new_filename];
}

?>