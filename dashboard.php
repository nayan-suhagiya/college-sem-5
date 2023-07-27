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
  ?>

  <?php
    if(!isset($_SESSION["user_id"])){
    header("location:./index.php");
    }

    $user_id = $_SESSION["user_id"];
    $username = $_SESSION["username"];

    echo "
    <div class='container my-4'>
      <h4  class='text-center'>Welcome <span class='text-custom text-decoration-underline'>$username</span> Explore the blog posts!!</h4>    
    </div>  
    ";
  ?>

  <div class='container my-3'>
    <div class='row'>

      <?php
     $query = "SELECT * FROM Blog_Posts";
    $runquery = mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($runquery)) {
      // print_r($row);
      $title = $row["title"];
      $content = $row["content"];
      $tag = $row["tag"];
      $category = $row["category"];

     echo " 
      <div class='card mb-3 border-0'>
        <div class='row g-0'>
          <div class='col-md-4'>
            <img src='./assets/blog_default.png' class='img-fluid rounded-start' style='height:100%;width:100%;'>
          </div>
          <div class='col-md-8 border'>
            <div class='card-body'>
              <h5 class='card-title'>$title</h5>
              <p class='card-text'>$content</p>
              <p class='card-text'>
                <small class='text-body-secondary'>
                  <i class='las la-tags fs-5'></i> $tag
                </small>
              </p>
               <p class='card-text'>
                <small class='text-body-secondary'>
                  <i class='las la-th-list fs-5'></i> $category
                </small>
              </p>
              <p class='card-text'><small class='text-body-secondary'>Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
     ";
    }
    
  ?>
    </div>
  </div>

</body>

</html>