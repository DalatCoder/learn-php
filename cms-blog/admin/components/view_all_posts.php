<?php
function handle_submit()
{
    global $connection;

    if (!isset($_POST['submit'])) return;

    if (!isset($_POST['bulk_options']) || $_POST['bulk_options'] === "") {
        echo 'Please choose operation to perform';
        return;
    }

    if (!isset($_POST['checkboxArray'])) {
        echo 'Please choose the posts';
        return;
    }

    $checkboxArray = $_POST['checkboxArray'];
    if (count($checkboxArray) == 0) {
        echo 'Please choose the posts';
        return;
    }

    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
        case 'published':
            foreach ($checkboxArray as $checkboxValue) {
                $query = "UPDATE Posts SET post_status = 'published' WHERE post_id = $checkboxValue";
                $update_to_published_query = mysqli_query($connection, $query);
                if (!$update_to_published_query) {
                    die('Oops! Error when updating post status to be published ' . mysqli_error($connection));
                }
            }
            break;
        case 'draft':
            foreach ($checkboxArray as $checkboxValue) {
                $query = "UPDATE Posts SET post_status = 'draft' WHERE post_id = $checkboxValue";
                $update_to_draft_query = mysqli_query($connection, $query);
                if (!$update_to_draft_query) {
                    die('Oops! Error when updating post status to be draft ' . mysqli_error($connection));
                }
            }
            break;
        case 'delete':
            foreach ($checkboxArray as $checkboxValue) {
                $query = "DELETE FROM Posts WHERE post_id = $checkboxValue";
                $delete_post_query = mysqli_query($connection, $query);
                if (!$delete_post_query) {
                    die('Oops! Error when deleting post. ' . mysqli_error($connection));
                }
            }
            break;
        default:
            echo 'Oops! Something went wrong :( Try again later.';
            break;
    }
}

handle_submit();
?>

<form action="" method="post">
    <div id="bulkOptionContainer" class="col-xs-8 col-md-4" style="margin-bottom: 15px; padding-left: 0;">
        <select name="bulk_options" id="bulk_options" class="form-control">
            <option value="">Select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <span>&nbsp;</span>
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes" class="checkbox"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM Posts JOIN Categories ON post_category_id = cat_id";
        $select_all_posts_query = mysqli_query($connection, $query);
        if (!$select_all_posts_query) {
            die('Oops! Error when fetching posts data ' . mysqli_error($connection));
            return;
        }

        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
            $cat_title = $row['cat_title'];
            ?>
            <tr>
                <td><input type="checkbox" class="checkbox post_checkbox" value="<?php echo $post_id; ?>"
                           name="checkboxArray[]"></td>
                <td><?php echo $post_id; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><?php echo $post_title; ?></td>
                <td><?php echo $cat_title; ?></td>
                <td><?php echo $post_status; ?></td>
                <td><img width="100px" src="../images/<?php echo $post_image; ?>" alt="images"></td>
                <td><?php echo $post_tags; ?></td>
                <td><?php echo $post_comment_count; ?></td>
                <td><?php echo $post_date; ?></td>
                <td><a href="posts.php?source=edit_post&post_id=<?php echo $post_id; ?>">Edit</a></td>
                <td><a href="posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('selectAllBoxes').addEventListener('change', function (event) {
            var status = event.target.checked;

            Array.from(document.getElementsByClassName('post_checkbox')).forEach(function (checkbox) {
                    checkbox.checked = status;
                }
            );
        })
    });
</script>
