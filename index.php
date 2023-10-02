<?php
//  User Requests Password Reset
include "connection.php";
session_start();

if (isset($_SESSION["user_id"])) {
  header("location:./dashboard.php");
}

if (isset($_POST["submit"])) {
  //  Get form data
  $email = $_POST["email"];
  $passwd = $_POST["passwd"];

  //  Query the database for the user
  $query = "SELECT * FROM Users WHERE email='$email'";
  $result = mysqli_query($conn, $query);

  //  Check if a user with that email exists
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user_id"] = $row["user_id"];

    //  Verify the password
    if (password_verify($passwd, $row["password"])) {
      //  Redirect based on user type
      if ($row['user_type'] == "admin") {
        header("location:admin/dashboard.php");
      } else {
        header("location:./dashboard.php");
      }
    } else {
      //  Invalid credentials
      $message[] = array(
        'icon' => 'error',
        'type' => 'Login',
        'message' => 'Invalid credentials!'
      );
    }
  } else {
    //  User does not exist
    $message[] = array(
      'icon' => 'error',
      'type' => 'Login',
      'message' => 'User not exist'
    );
  }
}

use PHPMailer\PHPMailer\PHPMailer;

require 'lib/Exception.php';
require 'lib/PHPMailer.php';
require 'lib/SMTP.php';

$mail = new PHPMailer(true);


if (isset($_POST["sendMail"])) {
  //  Get email and generate a random token
  $email = $_POST['email'];
  $token = bin2hex(random_bytes(32)); // Generate a random token

  //  Check if the email exists in the database
  $q = "SELECT * FROM users WHERE email = '$email'";
  $rq = mysqli_query($conn, $q);
  $count = mysqli_num_rows($rq);

  if ($count) {
    //  If email exists, update the user's token
    $user_data = mysqli_fetch_assoc($rq);
    $q = "UPDATE users SET token = '$token' WHERE user_id = {$user_data['user_id']}";
    $rq = mysqli_query($conn, $q);

    if ($rq) {
      //  Prepare and send the password reset email
      $resetUrl = "http://localhost/college-sem-5/change-password.php?token=$token"; // Replace with your actual URL

      // Set up PHPMailer
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'kreract@gmail.com';
      $mail->Password = 'eyavnggxbaxpeeev';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Password Reset';

      // $mail->Body = "hello";
      $mail->Body = "
      <div style='font-family: Arial, sans-serif; text-align: center;'>
        <h2 style='color: #333;'>Password Reset</h2>
        <p style='font-size: 18px; color: #555;'>
          We've received a request to reset your password. <br> Click the link below to proceed.
        </p>
        <p style='background-color: #007BFF; padding: 10px; display: inline-block; border-radius: 5px;'>
          <a href='$resetUrl' style='color: #fff; text-decoration: none;'>Reset Password</a>
        </p>
      </div>
    ";

      // Send email
      if (!$mail->send()) {
        $message[] = array(
          'icon' => 'error',
          'type' => 'Send Email',
          'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo
        );
      } else {
        $message[] = array(
          'icon' => 'success',
          'type' => 'Send Email',
          'message' => 'Check your email for a password reset link.'
        );
      }
    } else {
      //  Handle errors when updating token
      $message[] = array(
        'icon' => 'error',
        'type' => 'Token',
        'message' => 'Something went wrong'
      );
    }
  } else {
    //  Handle case where email is not found in the database
    $message[] = array(
      'icon' => 'error',
      'type' => 'User',
      'message' => 'User not found.'
    );
  }
}


include "./alert_message.php";
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
          <form method="POST" class="text-center">
            <img class="mt-4 mb-2" src="./assets/site_logo.png" alt="" width="100">
            <!-- <h1 class="h3 mb-3 fw-bold">Please Log in</h1> -->

            <div class="form-floating my-2">
              <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">Enter Email</label>
            </div>
            <div class="form-floating my-2">
              <input type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password" required>
              <label for="floatingPassword">Enter Password</label>
            </div>
            <small class="text-end d-block"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript:void(0)">Forgot password?</a></small>
            <button class="btn btn-custom w-100 py-2 my-3" name="submit" type="submit">Log in</button>
            <div>
              <small class="text-center">Don't have an account? &nbsp;<a href="./signup.php">Sign Up</a></small>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>





  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" class="text-center" action="index.php">
            <div class="form-floating my-2">
              <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">Enter Email</label>
            </div>
            <button class="btn btn-custom w-100 py-2 my-3" name="sendMail" type="submit">Send link</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>