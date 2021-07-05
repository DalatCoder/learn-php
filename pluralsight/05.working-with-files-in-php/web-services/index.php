<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form>
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
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const title = document.getElementById('title').value;
            const author = document.getElementById('author').value;
            fetch(`put_handler.php?title=${title}&author=${author}`, {
                method: 'put',
                body: document.getElementById('content').files[0]
            });
        });
    </script>
</body>

</html>
