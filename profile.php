<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <?php
    include "./navbar_dash.php";

    $user_id = $_SESSION["user_id"];
    $username = $_SESSION["username"];

    $query = "select * from users where user_id='$user_id'";
    $runquery = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($runquery);

    $email = $row["email"];
    $password = $row["password"];

    echo "
    <div class='container my-4'>
      <h4 class='text-center'>Welcome <span class='text-custom text-decoration-underline'>$username</span>!</h4>    
    </div>  
    ";

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $img_name = $_FILES['profile']['name'];

        if ($img_name == "") {
            $img_name = $image;
        } else {
            $path = "upload/profile/" . $img_name;
            copy($_FILES['profile']['tmp_name'], $path);
        }

        if (isset($_SESSION["user_id"])) {
            $query = "update users set name='$username',email='$email',image='$img_name',password='$password' where user_id=$user_id";
            $runquery = mysqli_query($conn, $query);

            if ($runquery) {
                echo "
                    <script>
                        alert('Profile Updated!');
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Unable to update profile!');
                    </script>
                ";
            }
        }

    }

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
                                    <img src="upload/profile/<?= $image ?>" height="100" class="img-radius"
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
                                            <?= $username ?>
                                        </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">
                                            <?= $email ?>
                                        </h6>
                                    </div>
                                </div>
                                <!-- <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Actions</h6> -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Password</p>
                                        <h6 class="text-muted f-w-400">
                                            <?= $password ?>
                                        </h6>

                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Actions</p>
                                        <h6 class="text-muted f-w-400"><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#editFromUser"><i
                                                    class="bi bi-pencil-square"></i></button></h6>
                                    </div>
                                </div>
                                <!-- <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                            data-original-title="facebook" data-abc="true"><i
                                                class="mdi mdi-facebook feather icon-facebook facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                            data-original-title="twitter" data-abc="true"><i
                                                class="mdi mdi-twitter feather icon-twitter twitter"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                            data-original-title="instagram" data-abc="true"><i
                                                class="mdi mdi-instagram feather icon-instagram instagram"
                                                aria-hidden="true"></i></a></li>
                                </ul> -->
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

                                <input class=' form-control' value="<?= $username ?>" type='text' required
                                    name='username'>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2" for='email'>Email</label>
                            <div class="col-8">
                                <input class=' form-control' value="<?= $email ?>" type='text' required name='email'>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2" for='email'>Password</label>
                            <div class="col-8">
                                <input class=' form-control' value="<?= $password ?>" type='text' required
                                    name='password'>
                            </div>
                        </div>
                        <div class='form-group row m-0 mt-2'>
                            <label class="col-4 my-2" for='image'>Profile image</label>
                            <div class="col-8">
                                <input type="file" id="image" class="form-control" name="profile">
                            </div>
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