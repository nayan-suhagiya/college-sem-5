<?php
include_once "connection.php";
session_start();
if (!isset($_SESSION["user_id"])) {
  header("location:./index.php");
}



$user_id = $_SESSION["user_id"];

$query = "SELECT * FROM Users WHERE user_id='$user_id'";
$runquery = mysqli_query($conn, $query);

// print_r($runquery);

$row = mysqli_fetch_assoc($runquery);
if ($row['user_type'] == "admin") {
  header("location:admin/dashboard.php");
}
$name = $row["name"];
$image = $row["image"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
    integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link href="../lib/css/style.css" rel="stylesheet"> -->
  <!-- <link href="../lib/css/bootstrap.min.css" rel="stylesheet"> -->

  <link href="./lib/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
  <header class="p-1 header_nav">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="./assets/site_logo.png" alt="logo" height="60">
        </a>

        <ul class="nav col-12 col-lg-auto me-2 mb-2 justify-content-center mb-md-0 ms-auto ">
          <li><a href="./dashboard.php" class="nav-link px-2 mt-1 ">Home</a></li>
          <li><a href="./add_blog.php" class="nav-link px-2 mt-1">Add Blog</a></li>
          <!-- <li><a href="#" class="nav-link px-2 ">Wishlist</a></li> -->
          <!-- <li><a href="./profile.php" class="nav-link px-2 ">Profile</a></li> -->
          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="upload/<?= $image ?>" alt="Profile" class="rounded-circle" height="30">
              <span class="d-none d-md-block dropdown-toggle ps-2"><?= $name ?></span>
            </a><!-- End Profile image Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6 class="fw-bolder"><?= $name ?></h6>
                <span>Web Designer</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="profile.php">
                  <i class="me-4 bi bi-person"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                  <!-- <i class="me-4 bi bi-gear"></i> -->
                  <i class="me-4 bi bi-postcard-heart"></i>
                  <span>My Posts</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                  <!-- <i class="me-4 bi bi-question-circle"></i> -->
                  <i class="me-4 bi bi-star"></i>
                  <span>Wish List</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="./logout.php">
                  <i class="me-4 bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li>
        </ul>

        <!-- <div class="text-end">
          <a href="./logout.php">
            <button type="button" class="btn btn-custom me-2">
              Logout
            </button>
          </a>
        </div> -->


      </div>
    </div>
  </header>


</body>

</html>
<script src="./lib/js/main.js"></script>
<script src="./lib/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
  integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
</script>