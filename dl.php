<?php
error_reporting(0); ini_set('display_errors', 0);
$file = $_GET['file'];
$size = filesize($file);
header("Content-Type: audio/mp4");
header('Accept-Ranges: bytes');
header("Content-Length: " . $size);
ob_clean();
flush();
readfile($file);
exit;
?>