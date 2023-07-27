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

    $user_id = $_SESSION["user_id"];
    
    if(isset($_POST["submit"])){
      // echo "form submitted";

      $title = $_POST["title"];
      $content = $_POST["content"];
      $tags = $_POST["tags"];
      $category = $_POST['category'];

      $query = "INSERT INTO Blog_Posts (user_id,title,content,tag,category) VALUES($user_id,'$title','$content','$tags','$category')";
      $runquery = mysqli_query($conn,$query);

      if($runquery){
        echo "
        <script>
          alert('Post added successfully!');
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
              <select name="tags" id="floatingTag" class="form-select">
                <option value=""></option>
                <?php
                  $query = "SELECT * FROM Tags";
                  $runquery = mysqli_query($conn,$query);

                  while($row = mysqli_fetch_assoc($runquery)){
                    $tagname = $row["NAME"];
                    
                    echo "
                      <option value='$tagname'>$tagname</option>
                    ";
                  }
                ?>
              </select>
              <label for="floatingTag">Select Tag</label>
            </div>
            <div class="form-floating my-2">
              <!-- <input type="text" name="tags" class="form-control" id="floatingTag" placeholder="Tags" required> -->
              <select name="category" id="floatingCategory" class="form-select">
                <option value=""></option>
                <?php
                  $query = "SELECT * FROM Categories";
                  $runquery = mysqli_query($conn,$query);

                  while($row = mysqli_fetch_assoc($runquery)){
                    $category = $row["NAME"];
                    
                    echo "
                      <option value='$category'>$category</option>
                    ";
                  }
                ?>
              </select>
              <label for="floatingCategory">Select Category</label>
            </div>
            <div class="form-group">
              <button class="btn btn-custom py-2 my-3" name="submit" type="submit">Post Blog</button>
              <a href="add_to_wishlist.php">
                <button class="btn btn-custom py-2 my-3" name="submit" type="submit">Add To Wishlist</button>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>