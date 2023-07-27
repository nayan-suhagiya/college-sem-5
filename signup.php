<?php
  include_once "connection.php";

  if(isset($_POST["submit"])){
    // echo "form submitted!";
    $name = $_POST["name"];
    $email = $_POST["email"];
    $passwd= $_POST["passwd"];

    echo $userid.$name.$email.$passwd;

    $query = "INSERT INTO Users(name,email,password) VALUES('$name','$email','$passwd')";
    $runquery = mysqli_query($conn,$query);

    if($runquery){
      header("location:./index.php");
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
    include_once "./navbar_root.php";
  ?>

  <div class="container" style="margin-top:17vh;">
    <div class="row">
      <div class="col-sm-4 m-auto">
        <div class="form-signin w-100 m-auto">
          <form method="POST" class="text-center">
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