<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
</head>

<body>
  <?php
  include "./navbar_dash.php";
  ?>

  <?php
  if (!isset($_SESSION["user_id"])) {
    header("location:./index.php");
  }

  $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];

  // echo "
  // <div class='container my-4'>
  //   <h4  class='text-center'>Welcome <span class='text-custom text-decoration-underline'>$username</span> Explore the blog posts!!</h4>    
  // </div>  
  // ";
  ?>


  <div class="container my-5">
    <div class="row">
      <?php
      $query = "SELECT * FROM blog_posts";
      $runquery = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($runquery)) {
        // print_r($row);
        $title = $row["title"];
        $content = $row["content"];
        $category = $row["category"];
        $created_at = $row["created_at"];

        ?>
        <!-- <div class='container my-3'>
    <div class='row'>
      <div class='card mb-3 border-0'>
        <div class='row g-0'>
          <div class='col-md-4'>
            <img class='img-fluid rounded-start' style='height:100%;width:100%;'>
          </div>
          <div class='col-md-8 border'>
            <div class='card-body'>
              <h5 class='card-title'></h5>
              <p class='card-text'></p>
              <p class='card-text'>
                <small class='text-body-secondary'>
                  <i class='las la-tags fs-5'></i>
                </small>
              </p>
              <p class='card-text'>
                <small class='text-body-secondary'>
                  <i class='las la-th-list fs-5'></i>
                </small>
              </p>
              <p class='card-text'><small class='text-body-secondary'>></small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

        <div class="col-sm-6">
          <div class="card">
            <img class="card-img" src='./assets/blog_default.png' alt="Post_Card">
            <div class="card-img-overlay">
              <a href="#" class="btn btn-light btn-sm">
                <?= $category ?>
              </a>
            </div>
            <div class="card-body">
              <h4 class="card-title">
                <?= $title ?>
              </h4>
              <small class="text-muted cat">
                <!-- <i class="far fa-clock text-info"></i><?= $tag ?> -->
                <!-- <i class="fas fa-users text-info"></i> 4 portions -->
              </small>
              <p class="card-text">
                <?= $content ?>
              </p>
              <!-- <a href="#" class="btn btn-info">Add to wishlist</a> -->
            </div>
            <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
              <div class="views">
                <?= $created_at ?>
              </div>
              <div class="stats">
                <i class="bi bi-heart-fill"></i> 1347
                <i class="bi bi-chat-square-dots"></i> 12
              </div>

            </div>
          </div>
        </div>

        <?php
      }
      ?>
    </div>
  </div>


  <!-- <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card">
          <img class="card-img"
            src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="Bologna">
          <div class="card-img-overlay">
            <a href="#" class="btn btn-light btn-sm">Cooking</a>
          </div>
          <div class="card-body">
            <h4 class="card-title">Pasta with Prosciutto</h4>
            <small class="text-muted cat">
              <i class="far fa-clock text-info"></i> 30 minutes
              <i class="fas fa-users text-info"></i> 4 portions
            </small>
            <p class="card-text">I love quick, simple pasta dishes, and this is one of my favorite.</p>
            <a href="#" class="btn btn-info">Read Recipe</a>
          </div>
          <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
            <div class="views">Oct 20, 12:45PM
            </div>
            <div class="stats">
              <i class="far fa-eye"></i> 1347
              <i class="far fa-comment"></i> 12
            </div>

          </div>
        </div>
      </div>
    </div>
  </div> -->
</body>

</html>