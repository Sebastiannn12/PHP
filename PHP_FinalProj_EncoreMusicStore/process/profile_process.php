<?php
require_once('../includes/auth.php');
require_buyer();

$user_id = current_user_id();
$full_name = trim($_POST['full_name'] ?? '');
$address = trim($_POST['address'] ?? '');
$contact_number = trim($_POST['contact_number'] ?? '');
$profile_image = null;

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
    $uploaded_file = $_FILES['profile_image'];

    if ($uploaded_file['error'] !== UPLOAD_ERR_OK) {
        header('Location: ../profile.php?error=upload');
        exit;
    }

    if ($uploaded_file['size'] > 5 * 1024 * 1024) {
        header('Location: ../profile.php?error=size');
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
        header('Location: ../profile.php?error=type');
        exit;
    }

    $upload_directory = __DIR__ . '/../uploads/profile';
    if (!is_dir($upload_directory) && !mkdir($upload_directory, 0755, true)) {
        header('Location: ../profile.php?error=upload');
        exit;
    }

    $profile_image = 'user-' . $user_id . '-' . bin2hex(random_bytes(8)) . '.' . $allowed_types[$mime_type];
    if (!move_uploaded_file($uploaded_file['tmp_name'], $upload_directory . DIRECTORY_SEPARATOR . $profile_image)) {
        header('Location: ../profile.php?error=upload');
        exit;
    }
}

if ($profile_image !== null) {
    $stmt = mysqli_prepare($conn, "UPDATE users SET full_name=?, address=?, contact_number=?, profile_image=? WHERE user_id=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $full_name, $address, $contact_number, $profile_image, $user_id);
} else {
    $stmt = mysqli_prepare($conn, "UPDATE users SET full_name=?, address=?, contact_number=? WHERE user_id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $full_name, $address, $contact_number, $user_id);
}
mysqli_stmt_execute($stmt);

$_SESSION['user_name'] = $full_name;
log_activity($conn, 'Updated profile');

header('Location: ../profile.php?updated=1');
exit;
?>
