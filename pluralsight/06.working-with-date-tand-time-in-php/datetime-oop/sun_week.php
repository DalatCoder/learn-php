<?php
ini_set('date.timezone', 'Asia/Ho_Chi_Minh');
$date = new DateTime();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        tr,
        th,
        td {
            border: 1px solid #333;
            margin: 0;
            padding: 7px;
        }
    </style>
</head>

<body>

    <h1>Sunrise and Sunset for next 7 days</h1>

    <div>
        <form action="" method="POST">
            <div class="form-control">
                <label for="latitude">Latitude: </label>
                <input type="text" id="latitude" name="latitude">
            </div>
            <div class="form-control">
                <label for="longitude">Longitude: </label>
                <input type="text" id="longitude" name="longitude">
            </div>
            <div class="form-control">
                <button name="submit" type="submit">Check</button>
            </div>
        </form>
    </div>

    <?php if (isset($_POST['submit'])) : ?>
        <?php
        $long = isset($_POST['longitude']) && !empty($_POST['longitude']) ? $_POST['longitude'] : 108.472754;
        $lat = isset($_POST['latitude']) && !empty($_POST['latitude']) ? $_POST['latitude'] : 11.904979;
        ?>

        <div>
            <p>
                Longitude: <?= $long ?> <br>
                Latitude: <?= $lat ?>
            </p>
        </div>

        <table>
            <tr>
                <th style="width: 200px; text-align: center;">Date</th>
                <th style="width: 300px; text-align: center;">Sunrise</th>
                <th style="width: 300px; text-align: center;">Sunset</th>
            </tr>
            <?php for ($day = 0; $day <= 7; $day++) : ?>
                <?php
                $date = new DateTime("+{$day} day");
                $sun_info = date_sun_info($date->getTimestamp(), $lat, $long);

                $sunrise = date('g:i a', $sun_info['sunrise']);
                $sunset = date('g:i a', $sun_info['sunset']);
                ?>

                <tr>
                    <td><?= $date->format('D M j') ?></td>
                    <td><?= $sunrise ?></td>
                    <td><?= $sunset ?></td>
                </tr>

            <?php endfor; ?>
        </table>

    <?php endif; ?>

</body>

</html>
