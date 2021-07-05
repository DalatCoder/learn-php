<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP eReader</title>
</head>

<body>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') : ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Please select a book to upload</h2>
            <div>
                <input type="text" name="title" id="title" placeholder="Title">
            </div>
            <div>
                <input type="text" name="author" id="author" placeholder="Author">
            </div>
            <div>
                <input type="file" name="content" id="content">
            </div>
            <div>
                <button type="submit" name="submit" id="submit">Submit</button>
            </div>
        </form>

    <?php else : ?>
        <?php
        $title = basename($_REQUEST['title']);
        $author = basename($_REQUEST['author']);

        if ($author == '' || $author == '.' || $author == '..') {
            echo 'Invlid author name';
            exit;
        }

        $root = './uploads';

        if (!file_exists("$root/$author")) {
            mkdir("$root/$author");
        }

        $result = move_uploaded_file($_FILES['content']['tmp_name'], "$root/$author/$title.txt");
        if ($result) {
            echo 'File saved successfully';
        } else {
            echo 'Failed to save file';
        }
        ?>
    <?php endif; ?>

</body>

</html>
