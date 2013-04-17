<?php
/** 
 * Beautiful file reader.. 
 *
 * See:
 * https://groups.google.com/d/msg/jplayer/nSM2UmnSKKA/Hu76jDZS4xcJ
 * http://php.net/manual/en/function.readfile.php#86244
 */
error_reporting(0); ini_set('display_errors', 0);

$file = $_GET['file'];
$size = filesize($file);

$type = $_GET['type'];

if (!file_exists($file)) {
	header ("HTTP/1.1 404 Not Found");
	return;
}

$size	= filesize($file);
$time	= date('r', filemtime($file));

$fm	= @fopen($file, 'rb');
if (!$fm) {
	header ("HTTP/1.1 505 Internal server error");
	return;
}

$begin	= 0;
$end	= $size - 1;

if (isset($_SERVER['HTTP_RANGE'])) {
	if (preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $_SERVER['HTTP_RANGE'], $matches)){
		$begin	= intval($matches[1]);
		if (!empty($matches[2])) {
			$end	= intval($matches[2]);
		}
	}
}

if (isset($_SERVER['HTTP_RANGE'])) {
	header('HTTP/1.1 206 Partial Content');
} else {
	header('HTTP/1.1 200 OK');
}

header("Content-Type: audio/mpeg"); 
header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: no-cache');  
header('Accept-Ranges: bytes');
header('Content-Length:' . (($end - $begin) + 1));
if (isset($_SERVER['HTTP_RANGE'])) {
	header("Content-Range: bytes $begin-$end/$size");
}
header("Content-Disposition: inline; filename=$file");
header("Content-Transfer-Encoding: binary");
header("Last-Modified: $time");

$cur = $begin;
fseek($fm, $begin, 0);

while(!feof($fm) && $cur <= $end && (connection_status() == 0)) {
	print fread($fm, min(1024 * 16, ($end - $cur) + 1));
	$cur += 1024 * 16;
}