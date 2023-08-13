<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
  <link rel="stylesheet" href="./vendor/css/single_post.css">
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

  ?>

  <?php
  if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];

    $query = "SELECT * FROM blog_posts WHERE post_id=$post_id";
    $runquery = mysqli_query($conn, $query);

    if (mysqli_num_rows($runquery) == 1) {
      // print_r($row);
      $row = mysqli_fetch_assoc($runquery);
      $user_id = $row["user_id"];
      $post_id = $row["post_id"];
      $title = $row["title"];
      $content = $row["content"];
      $category = $row["category_id"];

      $category = "SELECT * FROM categories where category_id =  $row[category_id]";
      $categoryData = mysqli_query($conn, $category);
      $categoryName = mysqli_fetch_assoc($categoryData);
      $category = $categoryName["name"];
      $created_at = $row["created_at"];
      $image = $row["image"];
      $like_count = $row["like_count"];

      if ($like_count == null) {
        $like_count = 0;
      }

      $comment_count = $row["comment_count"];

      if ($comment_count == null) {
        $comment_count = 0;
      }

      $query1 = "select * from users where user_id='$user_id'";
      $runquery1 = mysqli_query($conn, $query1);

      $user = mysqli_fetch_assoc($runquery1);
    }
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-2">
          <div class="thumbnail">
            <img class="left" src="<?= $image ?>" />
          </div>
        </div>
        <div class="right">
          <h1>
            <?= $title ?>
          </h1>

          <div class="separator"></div>
          <p>
            <?= $content ?>
          </p>
          <div class="author mb-4">
            <div>
              <img src="<?= $user["image"] ?>" />
              <h5 class="ms-2 mb-0 mt-3">
                <?= $user["name"] ?>
              </h5>
            </div>
            <div>
              <div class="d-flex align-items-center lc_icons ms-auto">
                <!-- <a href="like.php?post_id=<?= $post_id ?>" class="me-3" target="_self"> -->
                <div onclick="likePost(<?= $post_id ?>)">
                  <i class="las la-thumbs-up fs-3"></i>&nbsp;
                </div>
                <div id="likeCount_<?= $post_id ?>" class="me-2">
                  <?= $like_count ?>
                </div>
                <!-- </a> -->
                <a href="">
                  <i class="lar la-comments fs-3"></i>&nbsp;
                  <?= $comment_count ?>
                </a>

                <i class="lar la-bookmark fs-3 ms-3"></i>&nbsp;
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/js/ajex-call.js"></script>

</html>

<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>