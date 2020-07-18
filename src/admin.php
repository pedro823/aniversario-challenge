<?php
session_start();

if (!$_SESSION['is_admin']) {
    header('Location: /logout.php');
    die();
}

$emails = scandir('emails');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/favicon.ico"/>
    <title>Admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
    <table class="tftable">
        <tr><th>Emails</th></tr>
        <? for ($i = 0; $i < count($emails); $i++) { 
            if (in_array($emails[$i], array(".", "..", ".htaccess"), true)) continue;
            ?>
        <tr>
            <td><a href="view_email.php?email=<? echo $emails[$i]; ?>"><? echo $emails[$i]; ?></a></td>
        </tr>
    <? } ?>
    </table>
</div>

</body>
</html>