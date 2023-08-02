<?php
require_once("../connection.php");
require_once "./sidebar.php";
if (isset($_POST["submit"]) && isset($_POST["title"])  && isset($_POST["post_id"]) && isset($_POST["content"]) && isset($_POST["tags"]) && isset($_POST["category"])) {

  $title = $_POST["title"];
  $category = $_POST["category"];
  $tags = $_POST["tags"];
  $content = $_POST["content"];
  $post_id = $_POST["post_id"];
  echo ("update  blog_posts set  title = '$title' ,content = '$content',tag = '$tags' ,category = '$category'    where post_id = '$post_id'");
  $query = "update  blog_posts set  title = '$title' ,content = '$content',tag= '$tags' ,category = '$category'    where post_id = '$post_id'";
  $runquery = mysqli_query($conn, $query);
  if ($runquery) {
    echo "
      <script>
        alert('Blog Post Update successfully!');
      </script>
      ";
  }
}
if (isset($_POST["insert"]) && isset($_POST["title"])  &&  isset($_POST["content"]) && isset($_POST["tags"]) && isset($_POST["category"])) {

  $title = $_POST["title"];
  $category = $_POST["category"];
  $tags = $_POST["tags"];
  $content = $_POST["content"];
  echo ("insert into  blog_posts ( user_id, title , content , tag ,category) values  ( '$user_id','$title' , '$content','$tags' ,'$category')");
  $query = "insert into  blog_posts ( user_id, title , content , tag ,category) values  ( '$user_id','$title' , '$content','$tags' ,'$category')";
  $runquery = mysqli_query($conn, $query);
  if ($runquery) {
    echo "
      <script>
        alert('Blog Post Update successfully!');
      </script>
      ";
  }
}


?>

<main id="main" class="main">
  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title float-start">Post Information</h5>
          <div class="btn btn-primary float-end" data-bs-toggle='modal' data-bs-target='#edit-category-modal'>Add Post</div>
          <!-- Table with stripped rows -->
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th scope="col">Sr No.</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Tag</th>
                <th scope="col">Category</th>
                <th scope="col" style="width:200px">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "SELECT * FROM blog_posts";
              $result = mysqli_query($conn, $query);
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
              ?><tr>
                  <th scope='row'><?= $i ?></th>
                  <td><?= $row["title"] ?></td>
                  <td><?= $row["content"] ?></td>
                  <td><?php
                      $tags = "SELECT * FROM tags where tag_id = $row[tag] ";
                      $data = mysqli_query($conn, $tags);
                      $tagName = mysqli_fetch_assoc($data);
                      echo ($tagName["name"]);
                      ?></td>
                  <td><?php
                      $category = "SELECT * FROM categories where category_id = $row[category] ";
                      $categoryData = mysqli_query($conn, $category);
                      $categoryName = mysqli_fetch_assoc($categoryData);
                      echo ($categoryName["name"]);
                      ?></td>
                  <td>
                    <form method="post" id='edit-form' class="m-0">
                      <input class='form-control' type='hidden' value="<?= $row["category_id"] ?>" name='category_id'>
                      <button class='btn btn-primary' type="button" data-bs-toggle='modal' data-bs-target='#edit-category-modal<?= $i ?>'><i class='bi bi-pencil'></i></button>
                      <button class='btn btn-danger' type="submit" name="delete"><i class='bi bi-trash'></i></button>
                    </form>
                  </td>
                </tr>
                <div class='modal  fade' id='edit-category-modal<?= $i ?>' tabindex='-1' style='display: none;' aria-hidden='true'>
                  <div class='modal-dialog  modal-lg modal-dialog-centered'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title'>Update Post(<?= $i ?>)</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <form method="post" id='edit-form'>
                        <div class='modal-body'>
                          <input class='form-control' value="<?= $row["post_id"] ?>" type='hidden' name='post_id'>
                          <div class='form-group row '>
                            <div class="col-4">
                              <label for='full_name'>Post Title</label>
                            </div>
                            <div class="col-8">
                              <input class='form-control' value="<?= $row["title"] ?>" type='text' name='title'>
                            </div>
                          </div>
                          <div class='form-group row '>
                            <div class="col-4">
                              <label for='full_name'>Post Content</label>
                            </div>
                            <div class="col-8">
                              <textarea class='form-control' name="content" id="" cols="30" rows="5"><?= $row["content"] ?></textarea>
                              <!-- <input class='form-control' value="<?= $row["content"] ?>" type='text' name='content'> -->
                            </div>
                          </div>
                          <div class='form-group row '>
                            <div class="col-4">
                              <label for="floatingTag">Enter Tag</label>
                            </div>
                            <div class="col-8">
                              <select name="tags" id="floatingTag" value="<?= $row["tag"] ?>" class="form-select">
                                <?php
                                $query = "SELECT * FROM Tags";
                                $runquery = mysqli_query($conn, $query);

                                while ($row1 = mysqli_fetch_assoc($runquery)) {
                                  $tagname = $row1["name"];
                                  $tagname_id = $row1["tag_id"];
                                  $selected =  $row["tag"] == $tagname_id ? 'selected' : '';
                                  echo "
                                       <option value='$tagname_id' $selected>$tagname</option>
                                   ";
                                }
                                ?>
                              </select>
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
                                  $selected =  $row["category"] == $category_id ? 'selected' : '';
                                  echo "
                                     <option value='$category_id'  $selected >$category</option>
                                  ";
                                }
                                ?>
                              </select>
                            </div>
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
                $i++;
              }
              ?>

            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div> <!-- Left side columns -->
    </div>
    <div class='modal fade' id='edit-category-modal' style='display: none;' aria-hidden='true'>
      <div class='modal-dialog modal-lg modal-dialog-centered'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title'>Add Category</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <form method="post" id='edit-form'>
            <div class='modal-body'>
              <input class='form-control' type='hidden' name='post_id'>
              <div class='form-group row '>
                <div class="col-4">
                  <label for='full_name'>Post Title</label>
                </div>
                <div class="col-8">
                  <input class='form-control' type='text' name='title'>
                </div>
              </div>
              <div class='form-group row '>
                <div class="col-4">
                  <label for='full_name'>Post Content</label>
                </div>
                <div class="col-8">
                  <textarea class='form-control' name="content" id="" cols="30" rows="5"></textarea>
                  <!-- <input class='form-control'  type='text' name='content'> -->
                </div>
              </div>
              <div class='form-group row '>
                <div class="col-4">
                  <label for="floatingTag">Enter Tag</label>
                </div>
                <div class="col-8">
                  <select name="tags" id="floatingTag" class="form-select">
                    <?php
                    $query = "SELECT * FROM Tags";
                    $runquery = mysqli_query($conn, $query);

                    while ($row1 = mysqli_fetch_assoc($runquery)) {
                      $tagname = $row1["name"];
                      $tagname_id = $row1["tag_id"];
                      $selected =  $row["tag"] == $tagname_id ? 'selected' : '';
                      echo "
                                       <option value='$tagname_id' $selected>$tagname</option>
                                   ";
                    }
                    ?>
                  </select>
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
                      $selected =  $row["category"] == $category_id ? 'selected' : '';
                      echo "
                                     <option value='$category_id'  $selected >$category</option>
                                  ";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
              <button type='submit' name="insert" class='btn btn-primary'>Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->