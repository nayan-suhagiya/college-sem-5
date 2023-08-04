<?php
include "connection.php";

if (isset($_POST["submit"])) {
  // echo "form submitted!";
  $name = $_POST["name"];
  $email = $_POST["email"];
  $passwd = $_POST["passwd"];
  $image = $_FILES["profile"]["name"];
  $tempname = $_FILES['profile']['tmp_name'];

  $path = "./upload/profile/" . time() . $image;

  $allowed_image_extension = array(
    "png",
    "jpg",
    "jpeg"
  );
  $file_extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
  // copy($tempname, $path);

  if (!in_array($file_extension, $allowed_image_extension)) {
    echo "
            <script>
              alert('Upload valid images. Only PNG,JPG and JPEG are allowed.');
            </script>
            ";
  } else if (move_uploaded_file($tempname, $path)) {
    $query = "INSERT INTO Users(name,email,password,image) VALUES('$name','$email','$passwd','$path')";
    $runquery = mysqli_query($conn, $query);
    if ($runquery) {

      echo "
                <script>
                  alert('Registred successfully!');
                </script>
                ";
      header("location:./index.php");
    }
  } else {
    echo "
            <script>
              alert(' Failed to upload image!');
            </script>
            ";
  }

  // echo $userid.$name.$email.$passwd;

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
              <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com"
                required>
              <label for="floatingEmail">Enter Email</label>
            </div>
            <div class="form-floating my-2">
              <input type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password"
                required>
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