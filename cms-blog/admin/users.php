<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<?php include "includes/authenticate.php"; ?>

<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php"; ?>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "components/page_heading.php"; ?>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-user"></i> Users
                        </li>
                    </ol>

                    <?php delete_user(); ?>

                    <?php
                    $source = '';
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    }

                    switch ($source) {
                        case 'add_user':
                            include "components/add_user.php";
                            break;

                        case 'edit_user':
                            include "components/edit_user.php";
                            break;

                        default:
                            include "components/view_all_users.php";
                            break;
                    }
                    ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
