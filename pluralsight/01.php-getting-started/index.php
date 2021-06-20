<?php

$name = '';
$password = '';
$gender = '';
$color = '';
$languages = [];
$comments = '';
$termAndCondition = '';

function getValue($key) {
    if (isset($_POST[$key])) {
        if (is_array($_POST[$key])) return $_POST[$key];
        else return htmlspecialchars($_POST[$key], ENT_QUOTES);
    }

    return NULL;
}

if (isset($_POST['submit'])) {

    $name = getValue('name');
    $password = getValue('password');
    $gender = getValue('gender');
    $color = getValue('color');
    $languages = getValue('languages');
    $comments = getValue('comments');
    $termAndCondition = getValue('tc');

    printf(
        "
        User name: %s <br>
        Password: %s <br>
        Gender: %s <br>
        Color: %s <br>
        Language(s): %s <br>
        Comments: %s <br>
        Term and Conditions: %s <br>
    ",
    $name,
    $password,
    $gender,
    $color,
    implode(' ', $languages),
    $comments,
    $termAndCondition
    );
}

?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <title>PHP Getting Started</title>
</head>

<body class="container py-5">
    <div class="row justify-content-center">
        <form class="col-6" action="" method="post">

            <div class="form-group">
                <label class="form-label" for="">User Name</label>
                <input class="form-control" type="text" name="name"> <br>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Gender</label>
                <div class="form-control">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" value="m" checked>
                        <label for="" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" value="f">
                        <label for="" class="form-check-label">Female</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Favorite color:</label>

                <select name="color" class="form-select">
                    <option value="">Please select</option>
                    <option value="#f00">red</option>
                    <option value="#0f0">green</option>
                    <option value="#00f">blue</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Languages spoken</label>
                <select class="form-select" multiple name="languages[]" id="">
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="it">Italian</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Comments</label>
                <textarea name="comments" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>

            <div class="form-group mb-3">
                <input class="form-check-input" type="checkbox" name="tc" value="ok"> I accept the T&amp;C <br>
            </div>

            <div class="form-group mb-3">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
            </div>
        </form>
    </div>
</body>
