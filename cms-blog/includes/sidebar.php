<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
        <div class="input-group">
            <input type="text" class="form-control" name="search" autocomplete="off">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div> <!-- /.input-group -->
    </form> <!-- /.search-form -->
</div>

<!-- Blog Login Well -->
<div class="well">
    <h4>Login your account</h4>
    <form action="login.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" id="username">
        </div> <!-- /.input-group -->
        <div class="form-group">
            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password" id="password">
        </div> <!-- /.input-group -->
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Login" name="login">
        </div> <!-- /.input-group -->
    </form> <!-- /.search-form -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <?php
        $query = "SELECT * FROM Categories";
        $select_all_categories_query = mysqli_query($connection, $query);
        if (!$select_all_categories_query) {
            die('Oops! Error when fetching category data ' . mysqli_error());
            return;
        }

        $count = mysqli_num_rows($select_all_categories_query);
        $categories = [];

        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
            array_push($categories, $row);
        }

        $first_list_end = ceil($count / 2);
        ?>
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <?php
                for ($i = 0; $i < $first_list_end; $i++) {
                    $title = $categories[$i]['cat_title'];
                    $id = $categories[$i]['cat_id'];
                    echo "
                            <li><a href='posts.php?source=categories&category_id=$id'>$title</a></li>
                        ";
                }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <?php
                for ($i = $first_list_end; $i < $count; $i++) {
                    $title = $categories[$i]['cat_title'];
                    $id = $categories[$i]['cat_id'];
                    echo "
                            <li><a href='posts.php?source=categories&category_id=$id'>$title</a></li>
                        ";
                }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>
