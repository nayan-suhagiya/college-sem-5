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
    require_once "./connection.php";

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $new_password = $_POST["new_password"];
        $renew_password = $_POST["renew_password"];
        $user_id = $_POST["user_id"];

        $q = "select * from users where user_id=$user_id";
        $rq = mysqli_query($conn, $q);

        $user_data = mysqli_fetch_assoc($rq);

        // if ($password == "" && $new_password == "" && $renew_password == "") {
    
        // }
    
        if (!password_verify($password, $user_data["password"])) {
            $message[] = array(
                'icon' => 'error',
                'type' => 'Update Profile',
                'message' => 'Current password is wrong!'
            );
            $isSuccess = false;
        } elseif ($new_password !== $renew_password) {
            $message[] = array(
                'icon' => 'error',
                'type' => 'Update Profile',
                'message' => 'Password does not match!'
            );
            $isSuccess = false;
        } else {

            if ($_FILES["profile"]["name"]) {
                $img_name = $_FILES['profile']['name'];
                $path = "./upload/profile/" . time() . $img_name;

                $allowed_image_extension = array(
                    "png",
                    "jpg",
                    "jpeg"
                );
                $file_extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);

                // echo $user_data["image"];
    
                if ($user_data["image"]) {
                    $removeFileName = $user_data["image"];
                    // echo $removeFileName;
    
                    $status = unlink($removeFileName) ? "The file " . $removeFileName . " deleted " : "Error while deleteting file " . $removeFileName;
                    // echo $status;
                }

                if (!in_array($file_extension, $allowed_image_extension)) {
                    $message[] = array(
                        'icon' => 'error',
                        'type' => 'Error',
                        'message' => 'Upload valid images. Only PNG and JPEG are allowed.'
                    );
                    $isSuccess = false;
                } else if (move_uploaded_file($_FILES['profile']['tmp_name'], $path)) {
                    $hash_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $query = "update users set name='$username',email='$email',image='$path',password='$hash_new_password' where user_id=$user_id";
                    $runquery = mysqli_query($conn, $query);

                    $query = "select * from users where user_id='$user_id'";
                    $runquery = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($runquery);

                    if ($runquery) {
                        $message[] = array(
                            'icon' => 'success',
                            'type' => 'Update Profile',
                            'message' => 'Profile updated successfully!',
                            'redirection' => 'logout.php'
                        );
                        $isSuccess = true;
                    } else {
                        $message[] = array(
                            'icon' => 'error',
                            'type' => 'Update Profile',
                            'message' => 'Unable to update!'
                        );
                        $isSuccess = false;
                    }
                }
            } else {
                $hash_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "update users set name='$username',email='$email',password='$hash_new_password' where user_id=$user_id";
                $runquery = mysqli_query($conn, $query);

                $query = "select * from users where user_id='$user_id'";
                $runquery = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($runquery);

                if ($runquery) {
                    $message[] = array(
                        'icon' => 'success',
                        'type' => 'Update Profile',
                        'message' => 'Profile updated successfully!',
                        'redirection' => 'logout.php'
                    );
                    $isSuccess = true;
                } else {
                    $message[] = array(
                        'icon' => 'error',
                        'type' => 'Update Profile',
                        'message' => 'Unable to update!'
                    );
                    $isSuccess = false;
                }
            }
        }
    }
    include "./alert_message.php";
    ?>

    <?php
    include "./navbar_dash.php";

    ?>

    <div class="container my-4">
        <div class="row">

            <div class="col-md-6">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center ">
                                <div class="m-b-25">
                                    <img src="<?= $row["image"] ?>" onerror="this.src='assets/site_logo.png'"
                                        height="100" class="img-radius" alt="User-Profile-Image">
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
                                    <!-- <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Actions</p>
                                        <h6 class="text-muted f-w-400"><button class="btn btn-custom"
                                                data-bs-toggle="modal" data-bs-target="#editFromUser"><i
                                                    class="bi bi-pencil-square"></i></button></h6>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Update Profile!</h3>
                <form method="post" id='update-form' enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
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
                                <input class=' form-control' type='password' name='password' required>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2">New Password</label>
                            <div class="col-8">
                                <input class=' form-control' type='password' name='new_password' required>
                            </div>
                        </div>
                        <div class='form-group row m-0'>
                            <label class="col-4 my-2">Retype New Password</label>
                            <div class="col-8">
                                <input class=' form-control' type='password' name='renew_password' required>
                            </div>
                        </div>
                        <div class='form-group row m-0 mt-2'>
                            <label class="col-4 my-2" for='image'>Profile image</label>
                            <div class="col-8">
                                <input type="file" id="image" class="form-control" value="<?= $row['image'] ?>"
                                    name="profile"
                                    onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="text-center mt-3 ">
                            <img class="rounded-5" id="output" height="120px" width="120px" src="<?= $row["image"] ?>">
                        </div>
                    </div>

                    <div style="float:right;">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-custom ms-2">Save
                            changes</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</body>

</html>