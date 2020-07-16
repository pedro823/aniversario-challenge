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
    <link rel="icon" href="static/favicon.ico"/>
</head>
<body>
    <nav style="text-align: center;">
        <? if ($_SESSION['is_admin']) { ?>
            <a href="admin.php">Access admin</a>
        <? } ?>
        <? if (!empty($_SESSION['user'])) { ?>
            <a href="logout.php">Logout</a>
        <? } ?>
    </nav>
    <div class="flex-container">
        <div class="flex-item">
            <div id="clockdiv"></div>
        </div>
    </div>
    <div class="hidden"><a href="login.php">Login</a></div>

    <script async defer src="js/index.js"></script>
</body>
</html>