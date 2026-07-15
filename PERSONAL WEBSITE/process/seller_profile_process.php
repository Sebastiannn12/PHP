<?php
require_once('../includes/auth.php');
require_seller();

if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] === UPLOAD_ERR_NO_FILE) {
    header('Location: ../seller/profile.php?image_error=upload');
    exit;
}

$uploaded_file = $_FILES['profile_image'];

if ($uploaded_file['error'] !== UPLOAD_ERR_OK) {
    header('Location: ../seller/profile.php?image_error=upload');
    exit;
}

if ($uploaded_file['size'] > 5 * 1024 * 1024) {
    header('Location: ../seller/profile.php?image_error=size');
    exit;
}

$allowed_types = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
];
$file_info = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $file_info->file($uploaded_file['tmp_name']);

if (!isset($allowed_types[$mime_type])) {
    header('Location: ../seller/profile.php?image_error=type');
    exit;
}

$upload_directory = __DIR__ . '/../uploads/profile';
if (!is_dir($upload_directory) && !mkdir($upload_directory, 0755, true)) {
    header('Location: ../seller/profile.php?image_error=upload');
    exit;
}

$user_id = current_user_id();
$profile_image = 'seller-' . $user_id . '-' . bin2hex(random_bytes(8)) . '.' . $allowed_types[$mime_type];

if (!move_uploaded_file($uploaded_file['tmp_name'], $upload_directory . DIRECTORY_SEPARATOR . $profile_image)) {
    header('Location: ../seller/profile.php?image_error=upload');
    exit;
}

$stmt = mysqli_prepare($conn, "UPDATE users SET profile_image = ? WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "si", $profile_image, $user_id);
mysqli_stmt_execute($stmt);

log_activity($conn, 'Updated seller profile photo');
header('Location: ../seller/profile.php?image_updated=1');
exit;
?>
