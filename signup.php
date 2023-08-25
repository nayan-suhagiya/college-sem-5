<?php
include "connection.php";

if (isset($_POST["submit"])) {
  // echo "form submitted!";
  $name = $_POST["name"];
  $email = $_POST["email"];
  $passwd = $_POST["passwd"];
  $image = $_FILES["profile"]["name"];
  $tempname = $_FILES['profile']['tmp_name'];


  $hash_passwd = password_hash($passwd, PASSWORD_DEFAULT);

  $path = "./upload/profile/" . time() . $image;
  $query = "select * from Users where email = '$email'";
  $runquery = mysqli_query($conn, $query);
  if (mysqli_num_rows($runquery) == 0) {
    
    $allowed_image_extension = array(
      "png",
      "jpg",
      "jpeg"
    );
    $file_extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
    // copy($tempname, $path);
  
    if (!in_array($file_extension, $allowed_image_extension)) {
      $message[] = array(
        'icon' => 'error',
        'type' => 'Error',
        'message' => 'Upload valid images. Only PNG and JPEG are allowed.'
      );
    } else if (move_uploaded_file($tempname, $path)) {
      $query = "INSERT INTO Users(name,email,password,image) VALUES('$name','$email','$hash_passwd','$path')";
      $runquery = mysqli_query($conn, $query);
      if ($runquery) {
        $message[] = array(
          'icon' => 'success',
          'type' => 'Register',
          'message' => 'Registred successfully!',
        );
        include "./alert_message.php";
        header("location:./index.php");
      }
    } else {
      $message[] = array(
        'icon' => 'error',
        'type' => 'Upload Image',
        'message' => 'Failed to upload image!'
      );
    }
  }else{
    $message[] = array(
      'icon' => 'error',
      'type' => 'Already Exist',
      'message' => 'User already exist'
    );
  }

  // echo $userid.$name.$email.$passwd;
  include "./alert_message.php";
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

  <div class="container" style="margin-top:17vh;">
    <div class="row">
      <div class="col-sm-4 m-auto">
        <div class="form-signin w-100 m-auto">
          <form method="POST" class="text-center" enctype="multipart/form-data">
            <img class="mt-4 mb-2" src="./assets/site_logo.png" alt="" width="100">
            <!-- <h1 class="h3 mb-3 fw-bold">Please fill up this form</h1> -->

            <div class="form-floating my-2">
              <input type="text" name="name" class="form-control" id="floatingName" placeholder="name surname" required>
              <label for="floatingName">Enter Name</label>
            </div>
            <div class="form-floating my-2">
              <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
              <label for="floatingEmail">Enter Email</label>
            </div>
            <div class="form-floating my-2">
              <input type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password" required>
              <label for="floatingPassword">Enter Password</label>
            </div>
            <div class="form-floating my-2">
              <input type="file" name="profile" class="form-control" id="floatingFile" required>
              <label for="floatingFile">Upload Profile Picture</label>
            </div>
            <button class="btn btn-custom w-100 py-2 my-3" name="submit" type="submit">Sign up</button>
            <div>
              <small class="text-center">Already have an account? &nbsp;<a href="./index.php">Log In</a></small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>