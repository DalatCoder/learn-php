<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<?php include "includes/authenticate.php"; ?>

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
                </div>
            </div>

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
