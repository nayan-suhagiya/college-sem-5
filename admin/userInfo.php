<?php
include_once "../connection.php";

if (isset($_POST["submit"])) {
    if (isset($_POST["name"]) && isset($_POST["user_id"]) && isset($_POST["email"]) && isset($_POST["user_type"])) {
        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $user_type = $_POST["user_type"];

        $filename = $_FILES["iamge"]["name"];
        $tempname = $_FILES["iamge"]["tmp_name"];
        $folder = "./upload/images/" . $filename;
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        $file_extension = pathinfo($_FILES["iamge"]["name"], PATHINFO_EXTENSION);
        $query = "select * from  where user_id = '$user_id' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row['iamge']) {
            $filename = "." . $row['iamge'];
            if (file_exists($filename)) {
                $status  = unlink($filename) ? 'The file ' . $filename . ' has been deleted' : 'Error deleting ' . $filename;
                echo $status;
            } else {
                echo 'The file ' . $filename . ' doesnot exist';
            }
        }
        if (!in_array($file_extension, $allowed_image_extension)) {
            echo "
            <script>
              alert('Upload valid images. Only PNG and JPEG are allowed.');
            </script>
            ";
        } else if (move_uploaded_file($tempname, "." . $folder)) {
            echo ("update  Users set  name = '$name' , email = '$email' , user_type = '$user_type', image = '$folder'  where user_id = '$user_id' ");
            $query = "update  Users set  name = '$name' , email = '$email' , user_type = '$user_type', image = '$folder'  where user_id = '$user_id' ";
            $runquery = mysqli_query($conn, $query);
            if ($runquery) {
                echo "
                <script>
                  alert('User Update successfully!');
                </script>
                ";
            }
        } else {
            echo "
            <script>
              alert('  Failed to upload image!');
            </script>
            ";
        }
        echo ($folder);
    } else {
        echo "
        <script>
          alert('Enter valid user details');
        </script>
        ";
    }
}
if (isset($_POST["delete"]) && isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];
    echo ("delete from Users  where user_id = '$user_id'");
    $query = "delete from Users  where user_id = '$user_id'";
    $runquery = mysqli_query($conn, $query);
    if ($runquery) {
        echo "
        <script>
          alert('User delete successfully!');
        </script>
        ";
    }
}
?>
<?php
include_once "./sidebar.php";
?>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Information</h5>

                    <!-- Table with stripped rows -->
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">Sr No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $query = "SELECT * FROM Users";
                            $result = mysqli_query($conn, $query);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <th scope='row'><?= $i ?></th>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["user_type"] ?></td>
                                    <td>
                                        <img class="rounded-5" height="70px" width="70px" src="<?= "." . $row["image"] ?>" alt="">
                                    </td>
                                    <td>
                                        <form method="post" id='edit-form'>
                                            <input class=' form-control' type='hidden' value="<?= $row["user_id"] ?>" name='user_id'>

                                            <button class='btn btn-primary' type="button" data-bs-toggle='modal' data-bs-target='#edit-employee-modal<?= $i ?>'><i class='bi bi-pencil'></i></button>
                                            <button class='btn btn-danger' type="submit" name="delete"><i class='bi bi-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class='modal fade' id='edit-employee-modal<?= $i ?>' tabindex='-1' style='display: none;' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>Update User()</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <form method="post" id='edit-form' enctype="multipart/form-data">
                                                <div class='modal-body'>
                                                    <input class=' form-control' type='hidden' value="<?= $row["user_id"] ?>" required name='user_id'>
                                                    <div class='form-group row m-0 mt-2'>
                                                        <label class="col-4 my-2" for='email'>Email</label>
                                                        <div class="col-8">
                                                            <input class=' form-control' value="<?= $row["email"] ?>" type='text' required name='email'>
                                                        </div>
                                                    </div>
                                                    <div class='form-group row m-0 mt-2'>
                                                        <label class="col-4 my-2" for='full_name'>Full Name</label>
                                                        <div class="col-8">

                                                            <input class=' form-control' value="<?= $row["name"] ?>" type='text' required name='name'>
                                                        </div>
                                                    </div>
                                                    <div class='form-group row m-0 mt-2'>
                                                        <label class="col-4 my-2" for='user_type'>User Type</label>
                                                        <div class="col-8">
                                                            <select required name="user_type" class="form-control ">
                                                                <option value="admin" <?php echo $row["user_type"] == "admin" ? "selected" : "" ?>>Admin</option>
                                                                <option value="client" <?php echo $row["user_type"] == "client" ? "selected" : "" ?>>Client</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='form-group row m-0 mt-2'>
                                                        <label class="col-4 my-2" for='iamge'>Profile iamge</label>
                                                        <div class="col-8">

                                                            <input type="file" id="iamge" class="form-control" required name="iamge">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                    <button type='submit' required name="submit" class='btn btn-primary'>Save changes</button>
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

    </section>
</main><!-- End #main -->