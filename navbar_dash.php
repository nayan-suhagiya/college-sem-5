<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="./vendor/css/style.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
    integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./vendor/css/main.css">
  <!-- <link rel="stylesheet" href="./vendor/css/variables.css"> -->
  <link rel="stylesheet" href="./vendor/swiper/swiper-bundle.min.css">
  <script src="./vendor/js/main.js"></script>
  <link href="./lib/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<?php
include "connection.php";
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

?>


<body>
  <header class="p-1 header_nav">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="./dashboard.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="./assets/site_logo.png" alt="logo" height="50">
        </a>
        <ul class="nav col-12 col-lg-auto me-2 mb-2 justify-content-center mb-md-0 ms-auto ">
          <li><a href="./dashboard.php" class="nav-link px-2 mt-1 ">Home</a></li>
          <li><a href="./add_blog.php" class="nav-link px-2 mt-1">Add Blog</a></li>
          <li><a href="./campaign_view_user.php" class="nav-link px-2 mt-1">Promotion </a></li>
          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="<?= $row["image"] ?>" onerror="this.src='assets/profile.png'" alt="Profile"
                class="rounded-circle" height="30">
              <span class="d-none d-md-block dropdown-toggle ps-2">
                <?= $name ?>
              </span>
            </a><!-- End Profile image Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6 class="fw-bolder text-capitalize  text-center">
                  <?= $name ?>
                </h6>
                <!-- <span>Web Designer</span> -->
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
                <a class="dropdown-item d-flex align-items-center" href="users_post.php">
                  <!-- <i class="me-4 bi bi-gear"></i> -->
                  <i class="me-4 bi bi-postcard-heart"></i>
                  <span>My Posts</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="saved_post.php">
                  <!-- <i class="me-4 bi bi-question-circle"></i> -->
                  <i class="me-4 bi bi-star"></i>
                  <span>Saved Post</span>
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

  <script src="./vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./lib/js/main.js"></script>
  <script src="./lib/js/bootstrap.bundle.min.js"></script>
</body>

</html>