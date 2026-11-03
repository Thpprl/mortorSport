<?php
$conn = mysqli_connect('localhost','demo','ephemeral-demo-only','zkp_db') or die('Database unavailable');
mysqli_set_charset($conn, 'utf8mb4');
function demo_escape($value) { global $conn; return is_array($value) ? array_map('demo_escape', $value) : mysqli_real_escape_string($conn, substr((string)$value,0,1000)); }
$_GET = array_map('demo_escape', $_GET);
$_POST = array_map('demo_escape', $_POST);
?>