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
    $category = $_POST['category'];

    $findCategory = mysqli_query($conn, "SELECT * FROM categories WHERE name='$category'");
    // print_r(mysqli_fetch_assoc($findCategory)["category_id"]);
  
    $category_id = mysqli_fetch_assoc($findCategory)["category_id"];

    $blog_image = $_FILES["blog_image"]["name"];

    echo $blog_image;
    $tmpname = $_FILES["blog_image"]["tmp_name"];
    $path = "./upload/blog/" . time() . $blog_image;

    $allowed_image_extension = array(
      "png",
      "jpg",
      "jpeg"
    );
    $file_extension = pathinfo($_FILES["blog_image"]["name"], PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_image_extension)) {
      echo "
            <script>
              alert('Upload valid images. Only PNG,JPG and JPEG are allowed.');
            </script>
            ";
    } else if (move_uploaded_file($tempname, $path)) {
      $query = "INSERT INTO blog_posts (user_id,title,content,category,image,category_id,created_at) VALUES($user_id,'$title','$content','$category','$path',$category_id,NOW())";


      $runquery = mysqli_query($conn, $query);

      if ($runquery) {
        echo "
        <script>
          alert('Post added successfully!');
        </script>
        ";
      }
    } else {
      echo "
            <script>
              alert(' Failed to upload image!');
            </script>
            ";
    }


  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-8 m-auto">
        <div class="form-signin w-100 m-auto">
          <form method="POST" class="text-center">
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
              <!-- <input type="text" name="tags" class="form-control" id="floatingTag" placeholder="Tags" required> -->
              <select name="category" id="floatingCategory" class="form-select">
                <?php
                $query = "SELECT * FROM Categories";
                $runquery = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($runquery)) {
                  $category = $row["name"];

                  echo "
                    <option value='$category'>$category</option>
                    ";
                }
                ?>
              </select>
              <label for="floatingCategory">Select Category</label>
            </div>
            <div class="form-floating my-2">
              <input type="file" name="blog_image" class="form-control" id="floatingBlogImage" placeholder="Title"
                required>
              <label for="floatingBlogImage">Upload blog image</label>
            </div>
            <div class="form-group">
              <button class="btn btn-custom py-2 my-3" name="submit" type="submit">Post Blog</button>
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