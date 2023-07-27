<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
</head>

<body>
  <?php
    include_once "./navbar_dash.php";

   $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];

    echo "
    <div class='container my-4'>
      <h4 class='text-center'>Welcome <span class='text-custom text-decoration-underline'>$username</span> Explore your profile!!</h4>    
    </div>  
    ";

  ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-8 m-auto">

      </div>
    </div>
  </div>
</body>

</html>