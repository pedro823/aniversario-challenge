<?php
session_start();

if (!$_SESSION['is_admin']) {
    header('Location: /logout.php');
    die();
}

$db = new SQLite3('/db/website.db');
$bomb = $db->querySingle('SELECT attempts_left, active, defuse_password FROM bombs WHERE bomb_id = 1', true);

if (!$bomb['active']) {
    header('Location: /');
    die();
}

$chances = $bomb['attempts_left'];

if ($chances <= 0) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Defuse</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="icon" href="static/favicon.ico"/>
    </head>
    <body>
        <div class="flex-container">
            <div class="flex-item">
                <h4>You have entered the wrong password too many times.</h4>
                <h4>There is no stopping the bomb anymore.</h4>
            </div>
        </div>
    </body>
    </html>
<?
    die();
}

function onPost() {
    global $chances;
    global $db;
    if ($chances <= 0) {
        return;
    }

    $password = md5(trim($_REQUEST['password']));
    $defused = FALSE;
    if ($password === $bomb['defuse_password']) {
        $defused = TRUE;
    } else {
        $chances--;
    }
    $active = !$defused;
    $result = $db->exec("UPDATE bombs SET attempts_left = $chances, active = $active WHERE bomb_id = 1");
    var_dump($result);

    if ($defused) {
        header('Location: /');
        die();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    onPost();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defuse</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="static/favicon.ico"/>
</head>
<body>
    <div class="flex-container">
        <div class="flex-item">
            <h4>Warning. This stops the bomb from going off completely.</h4>
            <h4>You have <? echo $chances ?> chances left.</h4>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="password"><b>Password</b></label>
                <input type="text" placeholder="Enter Password" name="password" required>

                <button type="submit">Submit password</button>
            </form>
        </div>
    </div>
</body>
</html>