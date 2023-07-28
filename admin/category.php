<?php
    include_once "./sidebar.php";
    ?>
<main id="main" class="main">
  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Blog Category Information</h5>

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
                                    echo "<tr>
                                                <th scope='row'>$i</th>
                                                <td>$row[name]</td>
                                                <td>
                                                <button class='btn btn-primary' data-bs-toggle='modal' onclick='modalOpen()' data-bs-target='#edit-category-modal'><i class='bi bi-pencil'></i></button>
                                                <button class='btn btn-danger'><i class='bi bi-trash'></i></button>
                                                </td>
                                                </tr>";
                                    $i++;
                                }

                                ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div> <!-- Left side columns -->
    </div>
    <div class="modal fade" id="edit-category-modal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Category()</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="edit_category.php" id="edit-form">
            <div class="modal-body">
              <input class="form-control" type="hidden" name="id">
              <div class="form-group">
                <label for="full_name">Category Name</label>
                <input class="form-control" type="text" name="cat_name">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->