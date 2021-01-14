<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php include "../includes/db.php"; ?>
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

            <?php
            $query = "SELECT * FROM Posts";
            $select_all_posts_query = mysqli_query($connection, $query);
            if (!$select_all_posts_query) {
                die('Oops! Error when fetching number of posts.' . mysqli_error($connection));
            }

            $number_of_posts = mysqli_num_rows($select_all_posts_query);

            $query = "SELECT * FROM Comments";
            $select_all_comments_query = mysqli_query($connection, $query);
            if (!$select_all_comments_query) {
                die('Oops! Error when fetching number of comments. ' . mysqli_error($connection));
            }

            $number_of_comments = mysqli_num_rows($select_all_comments_query);

            $query = "SELECT * FROM Users WHERE user_role <> 'admin'";
            $select_all_guests_query = mysqli_query($connection, $query);
            if (!$select_all_guests_query) {
                die('Oops! Error when fetching number of guests. ' . mysqli_error($connection));
            }

            $number_of_guests = mysqli_num_rows($select_all_guests_query);

            $query = "SELECT * FROM Categories";
            $select_all_categories_query = mysqli_query($connection, $query);
            if (!$select_all_categories_query) {
                die('Oops! Error when fetching number of categories. ' . mysqli_error($connection));
            }

            $number_of_categories = mysqli_num_rows($select_all_categories_query);
            ?>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $number_of_posts; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $number_of_comments; ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $number_of_guests; ?></div>
                                    <div> Subscribers</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $number_of_categories ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Google Chart -->

            <div class="row">
                <div id="top_x_div" style="width: auto; height: 600px;"></div>
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

<?php
$query = "SELECT * FROM Posts WHERE post_status = 'published'";
$select_all_active_posts_query = mysqli_query($connection, $query);
if (!$select_all_active_posts_query) {
    die('Oops! Errors when fetching active posts data ' . mysqli_error($connection));
}

$number_of_active_posts = mysqli_num_rows($select_all_active_posts_query);


$query = "SELECT * FROM Posts WHERE post_status = 'draft'";
$select_all_draft_posts_query = mysqli_query($connection, $query);
if (!$select_all_draft_posts_query) {
    die('Oops! Errors when fetching draft posts data ' . mysqli_error($connection));
}

$number_of_draft_posts = mysqli_num_rows($select_all_draft_posts_query);

$query = "SELECT * FROM Comments WHERE comment_status = 'approved'";
$select_all_approved_comment_query = mysqli_query($connection, $query);
if (!$select_all_approved_comment_query) {
    die('Oops! Errors when fetching approved comments data ' . mysqli_error($connection));
}

$number_of_approved_comment = mysqli_num_rows($select_all_approved_comment_query);

$query = "SELECT * FROM Comments WHERE comment_status = 'unapproved'";
$select_all_unapproved_comment_query = mysqli_query($connection, $query);
if (!$select_all_unapproved_comment_query) {
    die('Oops! Errors when fetching unapproved comments data ' . mysqli_error($connection));
}

$number_of_unapproved_comment = mysqli_num_rows($select_all_unapproved_comment_query);

?>

<?php
$element_texts = [
    'Active Posts',
    'Draft Posts',
    'Comments',
    'Pending Comments',
    'Subscribers',
    'Categories'
];
$element_values = [
    $number_of_active_posts,
    $number_of_draft_posts,
    $number_of_approved_comment,
    $number_of_unapproved_comment,
    $number_of_guests,
    $number_of_categories
];
?>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['', 'Number'],
            <?php
            for ($i = 0; $i < count($element_texts); $i++) {
                $text = $element_texts[$i];
                $value = $element_values[$i];

                echo "['$text', $value],";
            }
            ?>
        ]);

        var options = {
            legend: {position: 'none'},
            chart: {
                title: 'General Chart',
                subtitle: ''
            },
            bar: {groupWidth: "50%"}
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
    };
</script>

</body>

</html>
