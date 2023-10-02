<?php
require_once("./connection.php");

if (isset($_POST["submit"])) {
    // Step 1: Get form data
    $new_password = $_POST["new_password"];
    $renew_password = $_POST["renew_password"];
    $token = $_GET["token"];
    
    // Step 2: Validate password length
    if (strlen($new_password) < 6) {
        $message[] = array(
            'icon' => 'error',
            'type' => 'Password Length',
            'message' => 'Password must be at least 6 characters long.'
        );
        $isSuccess = false;
    } else {
        // Step 3: Check if token is valid
        $q = "SELECT * FROM users WHERE token='$token'";
        $rq = mysqli_query($conn, $q);
        $count = mysqli_num_rows($rq);
        
        if ($count) {
            // Step 4: Check if passwords match
            if ($new_password != $renew_password) {
                $message[] = array(
                    'icon' => 'error',
                    'type' => 'Reset Password',
                    'message' => 'New password and confirm password do not match.'
                );
                $isSuccess = false;
            } else {
                // Step 5: Hash new password and update in database
                $hash_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password='$hash_new_password' WHERE token='$token'";
                $runquery = mysqli_query($conn, $query);
                
                if ($runquery) {
                    // Step 6: Password reset successful
                    $message[] = array(
                        'icon' => 'success',
                        'type' => 'Reset Password',
                        'message' => 'Password reset successfully!',
                        'redirection' => 'index.php'
                    );
                    $isSuccess = true;
                } else {
                    // Step 7: Unable to reset password
                    $message[] = array(
                        'icon' => 'error',
                        'type' => 'Reset Password',
                        'message' => 'Unable to Reset Password!'
                    );
                    $isSuccess = false;
                }
            }
        } else {
            // Step 8: Token is not valid
            $message[] = array(
                'icon' => 'error',
                'type' => 'Reset Password',
                'message' => 'Invalid Details Provide'
            );
            $isSuccess = false;
        }
    }
}

include "./alert_message.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
</head>

<body>
    <?php
    include "./navbar_root.php";
    ?>

    <div class="container" style="margin-top:20vh;">
        <div class="row">
            <div class="col-sm-4 m-auto">
                <div class="form-signin w-100 m-auto">
                    <form method="POST" class="text-center">
                        <img class="mt-4 mb-2" src="./assets/site_logo.png" alt="" width="100">
                        <!-- <h1 class="h3 mb-3 fw-bold">Please Log in</h1> -->


                        <div class="form-floating my-2">
                            <input type="password" name="new_password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Enter Password</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="password" name="renew_password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Enter Confirem Password</label>
                        </div>
                        <button class="btn btn-custom w-100 py-2 my-3" name="submit" type="submit">Log in</button>
                        <div>
                            <small class="text-center">Don't have an account? &nbsp;<a href="./signup.php">Sign Up</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>