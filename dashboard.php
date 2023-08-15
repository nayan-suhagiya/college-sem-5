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

  // if (isset($_POST["like"]) && isset($_POST["post_id"])) {
  //   $post_id = $_POST["post_id"];

  //   $q = "INSERT INTO likes(post_id,user_id) VALUES($post_id,$user_id)";
  //   $rq = mysqli_query($conn, $q);

  //   if ($rq) {
  //     $q = "SELECT like_count FROM blog_posts WHERE post_id=$post_id";
  //     $rq = mysqli_query($conn, $q);

  //     if (mysqli_num_rows($rq) == 1) {
  //       $row = mysqli_fetch_assoc($rq);

  //       // print_r($row);
  //       $like_count = $row["like_count"];

  //       if ($like_count == null) {
  //         $like_count = 1;
  //       } else {
  //         $like_count += 1;
  //       }

  //       $q = "UPDATE blog_posts SET like_count=$like_count WHERE post_id=$post_id";
  //       $rq = mysqli_query($conn, $q);

  //       if ($rq) {

  //       } else {

  //       }
  //     }
  //   }
  // }

  ?>

  <!-- Hero slider -->
  <section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12 parent">
          <div class="swiper sliderFeaturedPosts card card-1 ">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a class="img-bg d-flex align-items-end" style="background-image: url('./assets/post-slide-1.jpeg');">
                  <div class="img-bg-inner text-white">
                    <h2>The Best Homemade Masks for Face (keep the Pimples Away)</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae
                      minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore
                      repudiandae quidem necessitatibus rem atque.</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide ">
                <a class="img-bg d-flex align-items-end" style="background-image: url('./assets/post-slide-2.jpeg');">
                  <div class="img-bg-inner text-white">
                    <h2>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae
                      minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore
                      repudiandae quidem necessitatibus rem atque.</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a class="img-bg d-flex align-items-end" style="background-image: url('./assets/post-slide-3.jpeg');">
                  <div class="img-bg-inner text-white">
                    <h2>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae
                      minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore
                      repudiandae quidem necessitatibus rem atque.</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a class="img-bg d-flex align-items-end" style="background-image: url('./assets/post-slide-4.jpeg');">
                  <div class="img-bg-inner text-white">
                    <h2>9 Half-up/half-down Hairstyles for Long and Medium Hair</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae
                      minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore
                      repudiandae quidem necessitatibus rem atque.</p>
                  </div>
                </a>
              </div>
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
              <div class="glass"><img src=" <?= $image ?>" alt="" onerror="this.src='assets/site_logo.jpg'" class=" img-fluid glass-image"></div>
              <div class="content">
                <span class="title">
                  <?= $title ?>
                </span>

              </div>
              <div class="bottom">
                <div class="d-flex align-items-center author w-100">
                  <div class="photo"><img src="<?= $user["image"] ?>" onerror="this.src='assets/profile.png'" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">
                      <?= $user["name"] ?>
                    </h3>
                  </div>
                  <div class="d-flex  align-items-center lc_icons ms-auto">
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
                    <!-- <form method="POST">
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                    <button type="submit" class="btn btn-danger" name="like">
                      <i class="las la-thumbs-up fs-3"></i>&nbsp;
                      <?= $like_count ?>
                    </button>
                    <button type="submit" class="btn btn-warning" name="comment">
                      <i class="lar la-comments fs-3"></i>&nbsp;
                      <?= $comment_count ?>
                    </button>
                  </form> -->

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