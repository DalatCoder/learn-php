<?php include "includes/db.php"; ?>

<?php
$register_success = false;

function handle_submit()
{
    global $connection;

    if (!isset($_POST['submit'])) return;

    $username = $_POST['username'];
    if (!$username) {
        echo 'Username cannot be empty';
        return;
    }

    $email = $_POST['email'];
    if (!$email) {
        echo 'Email cannot be empty';
        return;
    }

    $password = $_POST['password'];
    if (!$password) {
        echo 'Password cannot be empty';
        return;
    }

    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT rand_salt FROM Users LIMIT 1";
    $select_randSalt_query = mysqli_query($connection, $query);
    if (!$select_randSalt_query) {
        die('Oops! Error when fetching randSalt string. ' . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($select_randSalt_query);
    $rand_salt = $row['rand_salt'];

    $password = crypt($password, $rand_salt);

    $query = "INSERT INTO Users (user_username, user_email, user_password, user_role) ";
    $query .= "VALUES ('$username', '$email', '$password', 'subscriber')";

    $register_user_query = mysqli_query($connection, $query);
    if (!$register_user_query) {
        die('Oops! Error when creating new user. ' . mysqli_error($connection));
    }

    $register_success = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php"; ?>
</head>

<body>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>;

<!-- Page Content -->
<div class="container">

    <section id="registration">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center">Register</h1>
                        <?php
                        handle_submit();
                        if ($register_success) {
                            ?>
                            <p class="text-center">Your registration has been summitted. Back to <a href="index.php">Home Page</a></p>
                            <?php
                        }
                        ?>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    $("#login-form").submit(function (e) {
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#key").val();

        var errorMessage = "";
        if (username.trim().length === 0) {
            errorMessage += "Username cannot be empty\n";
        }
        if (email.trim().length === 0) {
            errorMessage += "Email cannot be empty\n";
        }
        if (password.trim().length === 0) {
            errorMessage += "Password cannot be empty\n";
        } else if (password.trim().length < 3) {
            errorMessage += "Password length must be greater than or equal 3 characters\n";
        }

        if (errorMessage.length > 0) {
            alert(errorMessage);
            return false;
        }
    });
</script>

</body>

</html>
