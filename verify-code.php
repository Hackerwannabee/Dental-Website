<?php
session_start();

$inputCode = $_POST['code'] ?? '';
$savedCode = $_SESSION['email_code'] ?? '';
$expiry = $_SESSION['email_code_expiry'] ?? 0;

if ($inputCode === $savedCode && time() <= $expiry) {
    $_SESSION['is_admin'] = true;
    unset($_SESSION['email_code'], $_SESSION['email_code_expiry']);
    header('Location: admin.html');
    exit;
}

header('Location: all-articles.php?error=1');
exit;