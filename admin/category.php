<?php
include_once "../connection.php";

if (isset($_POST["submit"]) && isset($_POST["name"]) && isset($_POST["category_id"])) {

  $category_id = $_POST["category_id"];
  $name = $_POST["name"];
  echo ("update  categories set  name = '$name'   where category_id = '$category_id'");
  $query = "update  categories set  name = '$name'   where category_id = '$category_id'";
  $runquery = mysqli_query($conn, $query);
  if ($runquery) {
    echo "
      <script>
        alert('Category Update successfully!');
      </script>
      ";
  }
}
if (isset($_POST["insert"]) && isset($_POST["name"])) {

  $name = $_POST["name"];
  $query = "insert into  categories  (name) values('$name')";
  $runquery = mysqli_query($conn, $query);
  if ($runquery) {
    echo "
      <script>
        alert('Category Insert successfully!');
      </script>
      ";
  }
}
if (isset($_POST["delete"]) && isset($_POST["category_id"])) {
  $category_id = $_POST["category_id"];
  $query = "delete from categories  where category_id = '$category_id'";
  $runquery = mysqli_query($conn, $query);
  if ($runquery) {
    echo "
      <script>
        alert('Category delete successfully!');
      </script>
      ";
  }
}

include_once "./sidebar.php";

?>
<main id="main" class="main">
  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Blog Category Information</h5>
          <div class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#edit-category-modal'>Add category</div>
          <!-- Table with stripped rows -->
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th scope="col">Sr No.</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php $query = "SELECT * FROM Categories";
              $result = mysqli_query($conn, $query);
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
              ?><tr>
                  <th scope='row'><?= $i ?></th>
                  <td><?= $row["name"] ?></td>
                  <td>
                    <form method="post" id='edit-form' class="m-0">
                      <input class='form-control' type='hidden' value="<?= $row["category_id"] ?>" name='category_id'>
                      <button class='btn btn-primary' type="button" data-bs-toggle='modal' data-bs-target='#edit-category-modal<?= $i ?>'><i class='bi bi-pencil'></i></button>
                      <button class='btn btn-danger' type="submit" name="delete"><i class='bi bi-trash'></i></button>
                    </form>
                  </td>
                </tr>
                <div class='modal fade' id='edit-category-modal<?= $i ?>' tabindex='-1' style='display: none;' aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title'>Update Category()</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <form method="post" id='edit-form'>
                        <div class='modal-body'>
                          <input class='form-control' value="<?= $row["category_id"] ?>" type='hidden' name='category_id'>
                          <div class='form-group'>
                            <label for='full_name'>Category Name</label>
                            <input class='form-control' value="<?= $row["name"] ?>" type='text' name='name'>
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
      <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title'>Update Category()</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <form method="post" id='edit-form'>
            <div class='modal-body'>
              <!-- <input class='form-control' type='hidden' name='category_id'> -->
              <div class='form-group'>
                <label for='full_name'>Category Name</label>
                <input class='form-control' type='text' name='name'>
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