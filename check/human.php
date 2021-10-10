<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="human">
        <h1>Human Redirect</h1>
        <?php
            // $userAgent = strtolower(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : " ");
            echo $_SERVER['HTTP_USER_AGENT'];
        ?>
    </div>
</body>
</html>