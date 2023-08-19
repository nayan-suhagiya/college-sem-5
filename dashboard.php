<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog System</title>
  <link rel="stylesheet" href="./vendor/css/blog_new.css">
</head>

<body>
  <?php
  include "./navbar_dash.php";
  ?>

  <?php
  if (!isset($_SESSION["user_id"])) {
    header("location:./index.php");
  }

  $loggedin_user = $_SESSION["user_id"];
  ?>

  <!-- Hero slider -->
  <section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12 parent">
          <div class="swiper sliderFeaturedPosts card card-1 ">
            <div class="swiper-wrapper">
              <?php
              $q1 = "SELECT b.* FROM blog_posts b,campaigns c WHERE b.post_id=c.post_id AND c.status='running'";
              $runq1 = mysqli_query($conn, $q1);

              $rowCount = mysqli_num_rows($runq1);

              if ($rowCount > 0) {
                while ($row = mysqli_fetch_assoc($runq1)) {
                  $image = $row["image"];
                  $title = $row["title"];
                  $content = $row["content"];

                  ?>
                  <div class="swiper-slide">
                    <a class="img-bg d-flex align-items-end" style="background-image: url('<?= $image ?>');">
                      <div class="img-bg-inner text-white">
                        <h2>
                          <?= $title ?>
                        </h2>
                        <p>
                          <?= $content ?>
                        </p>
                      </div>
                    </a>
                  </div>
                  <?php
                }
              }
              ?>
            </div>
            <div class="custom-swiper-button-next">
              <span class="bi-chevron-right text-white"></span>
            </div>
            <div class="custom-swiper-button-prev">
              <span class="bi-chevron-left text-white"></span>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
      <div class="row g-5">
        <?php
        $query = "SELECT * FROM blog_posts";
        $runquery = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($runquery)) {
          // print_r($row);
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

          ?>
          <div class="parent col-lg-6">
            <div class="card card-1 ">
              <div class="logo">
                <span class="circle circle1"></span>
                <span class="circle circle2"></span>
                <span class="circle circle3"></span>
                <span class="circle circle4"></span>
                <span class="circle circle5">

                </span>

              </div>
              <div class="glass"><img src=" <?= $image ?>" alt="" onerror="this.src='assets/site_logo.jpg'"
                  class=" img-fluid glass-image"></div>
              <div class="content">
                <span class="title">
                  <?= $title ?>
                </span>

              </div>
              <div class="bottom">
                <div class="d-flex align-items-center author w-100">
                  <div class="photo"><img src="<?= $user["image"] ?>" onerror="this.src='assets/profile.png'" alt=""
                      class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">
                      <?= $user["name"] ?>
                    </h3>
                  </div>
                  <div class="d-flex  align-items-center lc_icons ms-auto">
                    <?php
                    // $q = "select * from likes where user_id=$loggedin_user";
                    // $rq = mysqli_query($conn, $q);
                  
                    // $count = mysqli_num_rows($rq);
                  
                    // if ($count > 0) {
                    //   $row = mysqli_fetch_assoc($rq);
                    //   print_r($row);
                    // }
                    ?>
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
                  </div>
                </div>
                <div class="view-more">
                  <a href="single_post.php?post_id=<?= $post_id ?>">
                    <button class="view-more-button">View more <i class="las la-angle-down fw-bold"></i></button>
                    <!-- <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linecap="round"
                      stroke-linejoin="round">
                      <path d="m6 9 6 6 6-6"></path>
                    </svg> -->
                  </a>
                </div>
              </div>

            </div>

          </div>




          <?php
        }
        ?>

      </div> <!-- End .row -->
    </div>
  </section> <!-- End Post Grid Section -->
</body>

<script src="vendor/js/ajex-call.js"></script>

</html>



<!-- <div class="col-lg-6">
  <div class="post-entry-1 lg">
    <div class="post-meta"><span class="date">
        <?= $category ?>
      </span> <span class="mx-1">&bullet;</span> <span>
        <?= $created_at ?>
      </span>
    </div>
    <h2><a href="single-post.html">
        <?= $title ?>
      </a>
    </h2>
    <a href="single-post.html"><img src=" <?= $image ?>" alt="" class="img-fluid"></a>
    <p class="mb-4 d-block">
      <?= $content ?>
    </p>

    <div class="d-flex align-items-center author">
      <div class="photo"><img src="<?= $user["image"] ?>" alt="" class="img-fluid"></div>
      <div class="name">
        <h3 class="m-0 p-0">
          <?= $user["name"] ?>
        </h3>
      </div>
      <div class="ms-auto lc_icons">
        <a href="like.php?post_id=<?= $post_id ?>" class="me-3" target="_self">
          <i class="las la-thumbs-up fs-3"></i>&nbsp;
          <?= $like_count ?>
        </a>
        <a href="">
          <i class="lar la-comments fs-3"></i>&nbsp;
          <?= $comment_count ?>
        </a>
      </div>
    </div>
  </div>
</div> -->


<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>