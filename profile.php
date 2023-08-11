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
    ob_start();
    require "./navbar_dash.php";

    $user_id = $_SESSION["user_id"];

    // $query = "select * from users where user_id='$user_id'";
    // $runquery = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($runquery);
    
    // $username = $row["name"];
    // $email = $row["email"];
    // $password = $row["password"];
    
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $img_name = $_FILES['profile']['name'];
        $new_password = $_POST["new_password"];
        $renew_password = $_POST["renew_password"];

        if ($password !== $row["password"]) {
            echo "
            <div class='col-sm-4 m-auto my-3'>
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Current password is wrong!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
              </div>
            ";
        } elseif ($new_password !== $renew_password) {
            echo "
            <div class='col-sm-4 m-auto my-3'>
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Password does not match!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
              </div>
            ";
        } else {
            $path = "./upload/profile/" . time() . $img_name;

            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            $file_extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);

            // echo $row["image"];
    
            if ($row["image"]) {
                $removeFileName = $row["image"];
                // echo $removeFileName;
    
                $status = unlink($removeFileName) ? "The file " . $removeFileName . " deleted " : "Error while deleteting file " . $removeFileName;
                // echo $status;
            }

            if (!in_array($file_extension, $allowed_image_extension)) {
                echo "
            <script>
              alert('Upload valid images. Only PNG,JPG and JPEG are allowed.');
            </script>
            ";
            } else if (move_uploaded_file($_FILES['profile']['tmp_name'], $path)) {
                $query = "update users set name='$username',email='$email',image='$path',password='$password' where user_id=$user_id";
                $runquery = mysqli_query($conn, $query);

                $query = "select * from users where user_id='$user_id'";
                $runquery = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($runquery);

                if ($runquery) {
                    // echo "
                    // <script>
                    //     alert('Profile Updated!');
                    //     </script>
                    //     ";
                    header("location:./profile.php");
                } else {
                    echo "
                    <script>
                    alert('Unable to update profile!');
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


    }
    ob_end_flush();
    ?>

    <!-- <div class="container">
    <div class="row">
      <div class="col-sm-8 m-auto">

      </div>
    </div>
  </div> -->
    <!-- <div class="page-content page-container" id="page-content">
        <div class="padding"> -->
    <div class="container my-4">
        <div class="row">

            <div class="col-xl-5 col-md-5">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center ">
                                <div class="m-b-25">
                                    <img src="<?= $row["image"] ?>" height="100" class="img-radius"
                                        alt="User-Profile-Image">
                                </div>
                                <!-- <h6 class="f-w-600">Hembo Tingor</h6>
                                <p>Web Designer</p> -->
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Profile Details</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Name</p>
                                        <h6 class="text-muted f-w-400">
                                            <?= $row["name"] ?>
                                        </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">
                                            <?= $row["email"] ?>
                                        </h6>
                                    </div>
                                </div>
                                <!-- <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Actions</h6> -->
                                <div class="row">
                                    <!-- <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Password</p>
                                        <h6 class="text-muted f-w-400">
                                            <?= $row["password"] ?>
                                        </h6>

                                    </div> -->
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Actions</p>
                                        <h6 class="text-muted f-w-400"><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#editFromUser"><i
                                                    class="bi bi-pencil-square"></i></button></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="editFromUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id='update-form' enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class='form-group row m-0 mt-2'>
                            <label class="col-4 my-2" for='full_name'>Name</label>
                            <div class="col-8">

                                <input class=' form-control' value="<?= $row["name"] ?>" type='text' required
                                    name='username'>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2" for='email'>Email</label>
                            <div class="col-8">
                                <input class=' form-control' value="<?= $row["email"] ?>" type='text' required
                                    name='email'>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2">Current Password</label>
                            <div class="col-8">
                                <input class=' form-control' type='password' required name='password'>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2">New Password</label>
                            <div class="col-8">
                                <input class=' form-control' type='password' required name='new_password'>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2">Retype New Password</label>
                            <div class="col-8">
                                <input class=' form-control' type='password' required name='renew_password'>
                            </div>
                        </div>
                        <div class='form-group row m-0 mt-2'>
                            <label class="col-4 my-2" for='image'>Profile image</label>
                            <div class="col-8">
                                <input type="file" id="image" class="form-control" value="<?= $row['image'] ?>"
                                    name="profile"
                                    onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"
                                    required>
                            </div>
                        </div>
                        <div class="text-center mt-3 ">
                            <img class="rounded-5" id="output" height="120px" width="120px" src="<?= $row["image"] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-custom">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- </div>
    </div> -->
    <!-- <script>
        function setName() {
            document.getElementById("submitBtn").setAttribute("name", "update")
        }
    </script> -->
</body>

</html>