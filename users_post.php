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

  $user_id = $_SESSION["user_id"];




  if (isset($_POST["submit"]) && isset($_POST["title"]) && isset($_POST["post_id"]) && isset($_POST["content"]) && isset($_POST["category"])) {

    $post_id = $_POST["post_id"];
    $title = $_POST["title"];
    $category = $_POST["category"];
    $content = $_POST["content"];
    if (
      $post_id &&
      $title &&
      $category &&
      $content
    ) {
      if ($_FILES["image"]["name"]) {
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./upload/post/" . time() . $filename;
        $allowed_image_extension = array(
          "png",
          "jpg",
          "jpeg"
        );
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $query = "select * from  blog_posts where post_id = '$post_id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row['image']) {
          $filenameRm = $row['image'];
          if (file_exists($filenameRm)) {
            $status = unlink($filenameRm) ? 'The file ' . $filenameRm . ' has been deleted' : 'Error deleting ' . $filenameRm;
            // echo $status;
          }
        }
        if (!in_array($file_extension, $allowed_image_extension)) {
          echo "
          <div class='col-sm-4 m-auto my-3'>
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          Upload valid images. Only PNG and JPEG are allowed.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          </div>
          ";
        } else if (move_uploaded_file($tempname, $folder)) {
          $query = "update  blog_posts set  title = '$title' ,content = '$content' ,category_id = '$category' , image = '$folder'    where post_id = '$post_id'";
          $runquery = mysqli_query($conn, $query);
          if ($runquery) {
            echo "
          <div class='col-sm-4 m-auto my-3'>
          <div class='alert alert-success alert-dismissible fade show' role='alert'>
          Blog Post update successfully!
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          </div>
          ";
          }
        }
      } else {
        $query = "update  blog_posts set  title = '$title' ,content = '$content' ,category_id = '$category'     where post_id = '$post_id'";
        $runquery = mysqli_query($conn, $query);
        if ($runquery) {
          echo "
          <div class='col-sm-4 m-auto my-3'>
          <div class='alert alert-success alert-dismissible fade show' role='alert'>
          Blog Post update successfully!
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          </div> ";
        }
      }
    } else {
      echo "
          <div class='col-sm-4 m-auto my-3'>
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          Unable to update!
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          </div>";
    }
  }

  $fetchQuery = "SELECT * FROM blog_posts WHERE user_id=$user_id";
  $fetchBlogRunQuery = mysqli_query($conn, $fetchQuery);

  ?>


  <div class="container my-4">
    <div class="row">
      <h2 class="col-sm-12 mb-4">Your created blogs...</h2>
      <?php

      while ($result = mysqli_fetch_assoc($fetchBlogRunQuery)) {
        // print_r($result);
        ?>
        <div class="col-sm-6">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?= $result["image"] ?>" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">
                    <?= $result["title"] ?>
                  </h5>
                  <p class="card-text">
                    <i class="bi bi-heart-fill"></i> <span>100</span>
                    <i class="bi bi-chat-dots"></i> <span>42</span>
                  </p>
                  <p class="card-text"><small class="text-body-secondary">
                      <?= $result["created_at"] ?>
                    </small>
                  </p>
                  <div>
                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle='modal'
                      data-bs-target='#edit-category-modal<?= $result["post_id"] ?>'>Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class='modal  fade' id='edit-category-modal<?= $result["post_id"] ?>' tabindex='-1' style='display: none;'
          aria-hidden='true'>
          <div class='modal-dialog  modal-lg modal-dialog-centered'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Update Post
                </h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <form method="post" id='edit-form' enctype="multipart/form-data">
                <div class='modal-body'>
                  <input class='form-control' value="<?= $result["post_id"] ?>" type='hidden' name='post_id'>
                  <div class='form-group row '>
                    <div class="col-4">
                      <label for='full_name'>Post Title</label>
                    </div>
                    <div class="col-8">
                      <input class='form-control' value="<?= $result["title"] ?>" type='text' name='title'>
                    </div>
                  </div>
                  <div class='form-group row '>
                    <div class="col-4">
                      <label for='full_name'>Post Content</label>
                    </div>
                    <div class="col-8">
                      <textarea class='form-control' name="content" id="" cols="30"
                        rows="5"><?= $result["content"] ?></textarea>
                    </div>
                  </div>
                  <div class='form-group row '>
                    <div class="col-4">
                      <label for="floatingCategory">Select Category</label>
                    </div>
                    <div class="col-8">
                      <select name="category" id="floatingCategory" class="form-select">
                        <?php
                        $query = "SELECT * FROM Categories";
                        $runquery = mysqli_query($conn, $query);

                        while ($row1 = mysqli_fetch_assoc($runquery)) {
                          $category = $row1["name"];
                          $category_id = $row1["category_id"];
                          $selected = $result["category_id"] == $category_id ? 'selected' : '';
                          echo "
                                     <option value='$category_id'  $selected >$category</option>
                                  ";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class='form-group row m-0 mt-2'>
                    <label class="col-4 my-2" for='image'>Profile image</label>
                    <div class="col-8">
                      <input type="file" accept="image/*" onchange="loadFile<?= $i ?>(event)" id="image"
                        class="form-control" name="image">
                    </div>
                  </div>
                  <div class="text-center mt-3 ">
                    <img class="rounded-5" id="output<?= $i ?>" height="120px" width="120px" src="<?= $result["image"] ?>"
                      alt="">
                    <script>
                      var loadFile<?= $i ?> = function (event) {
                        var output = document.getElementById('output<?= $i ?>');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function () {
                          URL.revokeObjectURL(output.src) // free memory
                        }
                      };
                    </script>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type='submit' name="submit" class='btn btn-primary'>Save changes</button>
                </div>
              </form>
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