<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'lib/Exception.php';
require 'lib/PHPMailer.php';
require 'lib/SMTP.php';

$mail = new PHPMailer(true);
// Step 1: User Requests Password Reset
include "connection.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Get email and generate a random token
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(32)); // Generate a random token

    // Step 2: Check if the email exists in the database
    $q = "SELECT * FROM users WHERE email = '$email'";
    $rq = mysqli_query($conn, $q);
    $count = mysqli_num_rows($rq);

    if ($count) {
        // Step 3: If email exists, update the user's token
        $user_data = mysqli_fetch_assoc($rq);
        $q = "UPDATE users SET token = '$token' WHERE user_id = {$user_data['user_id']}";
        $rq = mysqli_query($conn, $q);

        if ($rq) {
            // Step 4: Prepare and send the password reset email
            $resetUrl = "http://localhost/college-sem-5/change-password.php?token=$token"; // Replace with your actual URL

            // Set up PHPMailer
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'utsavparmar72@gmail.com';
            $mail->Password = 'uwouyrtictvexkxw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body = "Click the following link to reset your password: <a href='$resetUrl'>$resetUrl</a>";

            // Send email
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Check your email for a password reset link.';
            }
        } else {
            // Step 5: Handle errors when updating token
            echo "Unable to update token.";
        }
    } else {
        // Step 6: Handle case where email is not found in the database
        echo "User not found.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
</head>

<body>
    <?php
    include "./navbar_root.php";
    ?>

    <div class="container" style="margin-top:20vh;">
        <div class="row">
            <div class="col-sm-4 m-auto">
                <div class="form-signin w-100 m-auto">
           
                </div>
            </div>
        </div>
    </div>
</body>

</html>