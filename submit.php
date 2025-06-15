<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST["phone"]);
    $birthdate = $_POST["birthdate"];
    $appointment = $_POST["appointment"];
    $time = $_POST["time"];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'earlarthurjacob1@gmail.com';  // Your Gmail
        $mail->Password   = 'ggzt dytd kwra sotb';         // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // ---------- FIRST: Send to Admin ----------
        $mail->setFrom('earlarthurjacob1@gmail.com', 'Appointment Bot');
        $mail->addAddress('earlarthurjacob1@gmail.com');  // Your inbox

        $mail->isHTML(false);
        $mail->Subject = 'New Appointment Application';
        $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\nBirth Date: $birthdate\nAppointment Date: $appointment\nTime: $time";

        $mail->send();

        // ---------- SECOND: Send Confirmation to User ----------
        $mail->clearAllRecipients(); // clear previous recipient
        $mail->addAddress($email); // send to user's email
        $mail->Subject = 'Your Appointment is Confirmed';
        $mail->Body    = "Dear $name,\n\nThank you for your application.\nHere are your appointment details:\n\n".
                         "Appointment Date: $appointment\nTime: $time\n\nWe look forward to seeing you!\n\n– Dental Clinic";

        $mail->send();

        // Redirect to thank-you page
        header("Location: thankyou.html");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed.";
}
