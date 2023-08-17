<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
  <link rel="stylesheet" href="./vendor/css/profile.css">
</head>

<body>
  <?php
  require "./navbar_dash.php";
  ?>
  <?php

  $user_id = $_SESSION["user_id"];

  $q = "SELECT * FROM saved_posts WHERE user_id=$user_id";
  $rq = mysqli_query($conn, $q);

  if (mysqli_num_rows($rq) > 0) {
    while ($row = mysqli_fetch_assoc($rq)) {
      # code...
      // print_r($row["post_id"]);
      // $post_id = $row["post_id"];
      // $q = "SELECT * FROM blog_posts WHERE post_id IN ($post_id)";
      // $rq = mysqli_query($conn, $q);
  
      // if ($rq) {
      //   $row = mysqli_fetch_assoc($rq);
      //   print_r($row);
      // }
    }
    $q = "SELECT *
    FROM blog_posts 
    JOIN saved_posts ON blog_posts.post_id = saved_posts.post_id
    WHERE saved_posts.user_id=$user_id";
    $fetchBlogRunQuery = mysqli_query($conn, $q);
    // $result = mysqli_fetch_assoc($rq);
    // print_r($result);
  }
  include "./alert_message.php";

  ?>


  <div class="container my-4">
    <div class="row">
      <h2 class="col-sm-12 mb-4">Your saved blogs...</h2>
      <?php

      while ($result = mysqli_fetch_assoc($fetchBlogRunQuery)) {
        // print_r($result);
      
        if ($result["comment_count"] == null) {
          $result["comment_count"] = 0;
        }
        ?>
        <div class="col-sm-6">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?= $result["image"] ?>" onerror="this.src='assets/site_logo.png'"
                  class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">
                    <?= $result["title"] ?>
                  </h5>
                  <p class="card-text">
                    <i class="bi bi-heart-fill"></i> <span>
                      <?= $result["like_count"] ?>
                    </span>
                    <i class="bi bi-chat-dots"></i> <span>
                      <?= $result["comment_count"] ?>
                    </span>
                  </p>
                  <p class="card-text"><small class="text-body-secondary">
                      <?= $result["created_at"] ?>
                    </small>
                  </p>
                  <button class="btn btn-custom">
                    <a href="single_post.php?post_id=<?= $result["post_id"] ?>">
                      View More
                    </a>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>


        <?php
      }
      ?>
    </div>
  </div>

</body>

</html>

<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>