<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$email = $_POST['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email tidak valid.");
}

$code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
$_SESSION['email_code'] = $code;
$_SESSION['email_code_expiry'] = time() + 300;

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'earlarthurjacob1@gmail.com';
    $mail->Password = 'ggzt dytd kwra sotb';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('earlarthurjacob1@gmail.com', 'Admin Verifikasi');
    $mail->addAddress($email);
    $mail->Subject = 'Kode Verifikasi Admin';
    $mail->Body    = "Kode verifikasi kamu adalah: $code\n\nBerlaku selama 5 menit.";

    $mail->send();
    echo '<form action="verify-code.php" method="POST">
              <input type="text" name="code" placeholder="Masukkan kode verifikasi">
              <button type="submit">Verifikasi</button>
          </form>';
} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
?>