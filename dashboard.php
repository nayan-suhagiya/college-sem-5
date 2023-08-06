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

  // echo "
  // <div class='container my-4'>
  //   <h4  class='text-center'>Welcome <span class='text-custom text-decoration-underline'>$username</span> Explore the blog posts!!</h4>    
  // </div>  
  // ";
  ?>

  <!-- Hero slider -->
  <section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="swiper sliderFeaturedPosts">
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




  <!-- <section class="single-post-content">
    <div class="container-fluid">
      <div class="row"> -->
  <?php
  $query = "SELECT * FROM blog_posts";
  $runquery = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($runquery)) {
    // print_r($row);
    $title = $row["title"];
    $content = $row["content"];
    $category = "SELECT * FROM categories where category_id =  $row[category_id]";
    $categoryData = mysqli_query($conn, $category);
    $categoryName = mysqli_fetch_assoc($categoryData);
    $category = $categoryName["name"];
    $created_at = $row["created_at"];

  ?>

    <!-- <div class="col-sm-6">
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
                  <?= $tag ?>

                </small>
                <p class="card-text">
                  <?= $content ?>
                </p>

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
          </div> -->


    <!-- <div class="col-md-12 post-content" data-aos="fade-up">


            <div class="single-post" style="text-align:justify;">
              <div class="post-meta"><span class="date">
                  <?= $category ?>
                </span> <span class="mx-1">&bullet;</span> <span>
                  <?= $created_at ?>
                </span></div>
              <h1 class="mb-4">
                <?= $title ?>
              </h1>

              <figure class="my-4">
                <img src='./assets/blog_default.png' alt="" style="height:auto;width:auto;" class="img-fluid">

              </figure>
              <p>
                <?= $content ?>
              </p>



            </div>
          </div> -->


  <?php
  }
  ?>
  <!-- </div>
    </div>
  </section> -->

  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
      <div class="row g-5">
        <?php
        $query = "SELECT * FROM blog_posts";
        $runquery = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($runquery)) {
          // print_r($row);
          $user_id = $row["user_id"];
          $title = $row["title"];
          $content = $row["content"];
          $category = $row["category_id"];

          $category = "SELECT * FROM categories where category_id =  $row[category_id]";
          $categoryData = mysqli_query($conn, $category);
          $categoryName = mysqli_fetch_assoc($categoryData);
          $category = $categoryName["name"];
          $created_at = $row["created_at"];
          $image = $row["image"];

          $query1 = "select * from users where user_id='$user_id'";
          $runquery1 = mysqli_query($conn, $query1);

          $user = mysqli_fetch_assoc($runquery1);

        ?>

          <div class="col-lg-6">
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
              </div>
            </div>

          </div>
        <?php
        }
        ?>


        <!-- <div class="col-lg-4">
          <div class="row">
            <div class=" border-start custom-border">
              <div class="post-entry-1">
                <a href="single-post.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">&bullet;</span> <span>Jul 5th
                    '22</span></div>
                <h2><a href="single-post.html">Let’s Get Back to Work, New York</a></h2>
              </div>
              <div class="post-entry-1">
                <a href="single-post.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">Food</span> <span class="mx-1">&bullet;</span> <span>Jul 17th
                    '22</span></div>
                <h2><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
              </div>
              <div class="post-entry-1">
                <a href="single-post.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">Design</span> <span class="mx-1">&bullet;</span> <span>Mar
                    15th '22</span></div>
                <h2><a href="single-post.html">Why Craigslist Tampa Is One of The Most Interesting Places On the
                    Web?</a></h2>
              </div>
            </div>
          </div>
        </div> -->

      </div> <!-- End .row -->
    </div>
  </section> <!-- End Post Grid Section -->


</body>

</html>