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

  $user_id = $_SESSION["user_id"];

  if (isset($_POST["submit"])) {
    // echo "form submitted";
  
    $title = $_POST["title"];
    $content = $_POST["content"];
    $category_id = $_POST["category_id"];
    $image = $_FILES["image"]["name"];

    // echo $image;
    $tmpname = $_FILES["image"]["tmp_name"];
    $path = "./upload/post/" . time() . $image;

    $allowed_image_extension = array(
      "png",
      "jpg",
      "jpeg"
    );
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_image_extension)) {
      echo "
            <script>
              alert('Upload valid images. Only PNG,JPG and JPEG are allowed.');
            </script>
            ";
    } else if (move_uploaded_file($tmpname, $path)) {
      $query = "INSERT INTO blog_posts (user_id,title,content,image,category_id,created_at) VALUES($user_id,'$title','$content','$path',$category_id,NOW())";

      // echo $query;
  

      $runquery = mysqli_query($conn, $query);

      if ($runquery) {
        echo "
          <div class='col-sm-4 m-auto my-3'>
          <div class='alert alert-success alert-dismissible fade show' role='alert'>
          Post added successfully!
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          </div>
        ";
      }
    } else {
      echo "
            <div class='col-sm-4 m-auto my-3'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Failed to upload image!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>
            ";
    }


  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-8 m-auto">
        <div class="form-signin w-100 m-auto">
          <form method="post" class="text-center" enctype="multipart/form-data">
            <!-- <img class="mt-4 mb-2" src="./assets/site_logo.png" alt="" width="100"> -->
            <h1 class="h3 mt-4 mb-2 fw-bold text-custom">Add Blog Post Data</h1>

            <div class="form-floating my-2">
              <input type="text" name="title" class="form-control" id="floatingInput" placeholder="Title" required>
              <label for="floatingInput">Enter Title</label>
            </div>
            <div class="form-group my-2">
              <textarea type="content" placeholder="Write content here...." name="content" class="form-control" required
                rows="4"></textarea>
            </div>
            <div class="form-floating my-2">
              <select name="category_id" id="floatingCategory" class="form-select">
                <?php
                $query = "SELECT * FROM categories";
                $runquery = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($runquery)) {
                  $category = $row["name"];
                  $category_id = $row["category_id"];

                  echo "
                    <option value='$category_id'>$category</option>
                    ";
                }
                ?>
              </select>
              <label for="floatingCategory">Select Category</label>
            </div>
            <div class="form-floating my-2">
              <input type="file" name="image" class="form-control" accept="image/*"
                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"
                id="floatingBlogImage" placeholder="Title" required>
              <label for="floatingBlogImage">Upload blog image</label>
            </div>

            <div class="text-center mt-3 ">
              <img class="rounded-5" id="output" height="120px" width="120px" src="" alt="">
            </div>
            <div class="form-group">
              <button class="btn btn-custom py-2 my-3" name="submit" value="insertSubmit" type="submit">Post
                Blog</button>
              <a href="add_to_wishlist.php">
                <!-- <button class="btn btn-custom py-2 my-3" name="submit" type="submit">Add To Wishlist</button> -->
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>