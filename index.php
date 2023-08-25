<?php
include "connection.php";
session_start();

if (isset($_SESSION["user_id"])) {
  header("location:./dashboard.php");
}

if (isset($_POST["submit"])) {
  $email = $_POST["email"];
  $passwd = $_POST["passwd"];



  $query = "SELECT * FROM Users WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    // print_r($row);
    $_SESSION["user_id"] = $row["user_id"];
    if (password_verify($passwd, $row["password"])) {
      if ($row['user_type'] == "admin") {
        header("location:admin/dashboard.php");
      } else {
        header("location:./dashboard.php");
      }
    } else {
      $message[] = array(
        'icon' => 'error',
        'type' => 'Login',
        'message' => 'Invalid credentials!'
      );
    }
  } else {
    $message[] = array(
      'icon' => 'error',
      'type' => 'Login',
      'message' => 'User not exist'
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
            <button class="btn btn-custom w-100 py-2 my-3" name="submit" type="submit">Log in</button>
            <div>
              <small class="text-center">Don't have an account? &nbsp;<a href="./signup.php">Sign Up</a></small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>