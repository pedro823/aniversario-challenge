<?php
$db = new SQLite3('../website.db');
$query = 'SELECT active FROM bombs WHERE bomb_id = 1';
$bomb = $db->querySingle($query, true);

header('Content-type: application/json');
echo json_encode($bomb['active'] !== 0);
?>