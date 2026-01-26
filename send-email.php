<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Display errors (for debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load PHPMailer
require 'PHPMailer/PHPMailer-master/src/Exception.php';
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $firstContact   = htmlspecialchars($_POST["appointment"]);
    $shootDay   = htmlspecialchars($_POST["job"]);
    $deliveryDate   = htmlspecialchars($_POST["deadline"]);
    $phoneNumber   = htmlspecialchars($_POST["phone"]);


    $message = "Hoi $name, bedankt voor de reservering.
Onze eerste afspraak zal zijn op $firstContact. De schietdag zelf is op $shootDay. En u heeft een opleverdatum aangevraagd van $deliveryDate. 
Ik bel u zo snel mogelijk op $phoneNumber. 

Mocht deze informatie niet kloppen kunt u via de onderstaande link 1 week van te voren aanpassen.
<a href='about.php'>Werkt nog niet</a> ";

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sennasolcer@gmail.com';       // YOUR Gmail
        $mail->Password   = 'hifl dtae jxzu swjt';         // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('sennasolcer@gmail.com', 'Website Contact');
        $mail->addAddress($email);       // where you want emails
        $mail->addReplyTo($email, $name);

        $mail->Subject = 'New Contact Form Message';
        $mail->Body    =
            "Name: $name\n" .
            "Email: $email\n\n" .
            "Message:\n$message";

        $mail->send();
        echo "✅ Message sent successfully!";
    } catch (Exception $e) {
        echo "❌ Error: {$mail->ErrorInfo}";
    }
    header("location: reserveren.php?status=verzonden");

    exit;
}

?>
