<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog System | Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
  <link href="../lib/css/style.css" rel="stylesheet">
  <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
  <link href="../lib/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <script src="../lib/js/sweetalert2.all.js"></script>

</head>
<?php
include "../connection.php";
session_start();
if (!isset($_SESSION["user_id"])) {
  header("location:../index.php");
}


$user_id = $_SESSION["user_id"];

$query = "SELECT * FROM Users WHERE user_id='$user_id'";
$runquery = mysqli_query($conn, $query);


$row = mysqli_fetch_assoc($runquery);

$name = $row["name"];
$image = $row["image"];

if ($row['user_type'] == "client") {
  header("location:../dashboard.php");
}

?>


<body>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="../assets/site_logo.png" alt="">
        <!-- <span class="d-none d-lg-block">Admin</span> -->
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= "." . $image ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?= $name ?>
            </span>
          </a><!-- End Profile image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6 class="text-uppercase text-center">
                <?= $name ?>
              </h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li>
      </ul>
    </nav>

  </header>

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="userInfo.php">
          <i class="bi bi-person"></i>
          <span>User</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="blog_post.php">
          <i class="bi bi-postcard-fill"></i>
          <span>Post</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="category.php">
          <i class="bi bi-collection"></i>
          <span>Categories</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="promotion_package.php">
          <i class="bi bi-boxes"></i>
          <span>Promotion Package</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="campaign.php">
          <i class="bi bi-tags"></i>
          <span>Campaign Posts</span>
        </a>
      </li>
    </ul>

  </aside>
  <script src="../lib/js/main.js"></script>
  <script src="../lib/js/bootstrap.bundle.min.js"></script>

</body>

</html>