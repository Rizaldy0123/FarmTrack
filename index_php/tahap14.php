<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $gn = success();

    if  ($gn == 1) echo "Good job..";

    function success()
    {
        $a = 1;
        return $a;
    }
    ?>
</body>
</html>