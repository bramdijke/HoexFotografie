<?php
// Voeg de database verbinding toe!
require_once "includes/database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Display errors (for debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'PHPMailer/PHPMailer-master/src/Exception.php';
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Gegevens ophalen en beveiligen voor de database
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $appointment = mysqli_real_escape_string($db, $_POST['appointment']);
    $job = mysqli_real_escape_string($db, $_POST['job']);
    $deadline = mysqli_real_escape_string($db, $_POST['deadline']);
    $info = mysqli_real_escape_string($db, $_POST['task']);
    $customer_type = mysqli_real_escape_string($db, $_POST['option']);

    // 2. Eerst opslaan in de DATABASE
    $query = "INSERT INTO appointments (name, surname, `e-mail`, phone, appointment, job, deadline, info, file, customer_type) 
              VALUES ('$name', '$surname', '$email', '$phone', '$appointment', '$job', '$deadline', '$info', '', '$customer_type')";

    $db_success = mysqli_query($db, $query);

    // 3. Nu de EMAIL versturen (PHPMailer)
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sennasolcer@gmail.com';
        $mail->Password = 'hifl dtae jxzu swjt';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email ontvanger en inhoud
        $mail->setFrom('sennasolcer@gmail.com', 'HOEX Fotografie');
        $mail->addAddress($email);

        $mail->isHTML(true); // Zorg dat HTML links werken
        $mail->Subject = 'Bevestiging Reservering - HOEX Fotografie';

        $mailContent = "
            <h2>Hoi $name,</h2>
            <p>Bedankt voor de reservering. Hier zijn de details:</p>
            <ul>
                <li><strong>Eerste afspraak:</strong> $appointment</li>
                <li><strong>Schietdag:</strong> $job</li>
                <li><strong>Opleverdatum:</strong> $deadline</li>
            </ul>
            <p>Ik bel u zo snel mogelijk op $phone.</p>
            <p>Mocht deze informatie niet kloppen, kunt u dit tot 1 week van tevoren aanpassen via <a href='https://uwdomein.nl/about.php'>deze link</a>.</p>
        ";

        $mail->Body = $mailContent;
        $mail->AltBody = strip_tags($mailContent); // Voor email clients zonder HTML

        $mail->send();

    } catch (Exception $e) {
        // Log eventuele email fouten, maar ga wel door
        error_log("Email kon niet verzonden worden. Mailer Error: {$mail->ErrorInfo}");
    }

    // 4. Redirect terug naar de pagina met een succes melding
    header("location: reserveren.php?status=verzonden");
    exit;
}
?>