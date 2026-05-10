<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function test()
    {
        static $count = 0;
        echo $count;
        $count++;
    }
    echo test();
    echo test();
    echo test();
    ?>
</body>
</html>