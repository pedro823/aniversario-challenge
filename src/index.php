<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LondonBomb</title>
    <link rel="stylesheet" href="css/styles.css">
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/p5.min.js"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.1/addons/p5.dom.min.js"></script>
</head>
<body>
    <? if ($_SESSION['is_admin']) { ?>
        <a href="admin.php">Access admin</a>
    <? } ?>
    <? if (!empty($_SESSION['user'])) { ?>
        <a href="logout.php">Logout</a>
    <? } ?>
    <div id="clockdiv"></div>
    <div class="hidden"><a href="login.php">Login</a></div>

    <script async defer src="js/index.js"></script>
</body>
</html>