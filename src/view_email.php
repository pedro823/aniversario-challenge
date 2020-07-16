<?php
session_start();

if (!$_SESSION['is_admin']) {
    header('Location: /logout.php');
    die();
}

header('Content-type: text/plain');

$all_files = scandir('emails');
$forbidden_files = array('.', '..', '.htaccess');
$all_files = array_diff($all_files, $forbidden_files);

$file = $_REQUEST['email'];

if (!in_array($file, $all_files)) {
    echo 'Email not found';
    die();
}

include('emails/' . $file);
?>