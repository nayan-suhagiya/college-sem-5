<?php
include_once "../connection.php";

if (isset($_POST["submit"]) && isset($_POST["name"]) && isset($_POST["user_id"]) && isset($_POST["email"]) && isset($_POST["user_type"])) {

    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];
    echo ("update  Users name = '$name' , email = '$email' , user_type = '$user_type'  where user_id = '$user_id'");
    $query = "update  Users set  name = '$name' , email = '$email' , user_type = '$user_type'  where user_id = '$user_id'";
    $runquery = mysqli_query($conn, $query);
    if ($runquery) {
        echo "
        <script>
          alert('User Update successfully!');
        </script>
        ";
    }
}
if (isset($_POST["delete"]) && isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];
    echo("delete from Users  where user_id = '$user_id'");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
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
                                    <th scope="col">Image</th>
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
                                        <td><?= $row["image"] ?></td>
                                        <td>
                                            <form method="post" id='edit-form'>
                                            <input class='form-control' type='hidden' value="<?= $row["user_id"] ?>" name='user_id'>

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
                                                <form method="post" id='edit-form'>
                                                    <div class='modal-body'>
                                                        <input class='form-control' type='hidden' value="<?= $row["user_id"] ?>" name='user_id'>
                                                        <div class='form-group'>
                                                            <label for='email'>Email</label>
                                                            <input class='form-control' value="<?= $row["email"] ?>" type='text' name='email'>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='full_name'>Full Name</label>
                                                            <input class='form-control' value="<?= $row["name"] ?>" type='text' name='name'>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label for='user_type'>User Type</label>
                                                            <input class='form-control' value="<?= $row["user_type"] ?>" type='text' name='user_type'>
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

        </section>
    </main><!-- End #main -->
</body>
<?php
function demo()
{
}
?>


</html>