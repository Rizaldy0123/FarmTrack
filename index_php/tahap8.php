<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $temp = "The date is ";
    echo longdate(time());

    function longdate($timestamp)
    {
        global $temp;
        return $temp . date("l F jS Y", $timestamp);
    }
    ?>
</body>
</html>