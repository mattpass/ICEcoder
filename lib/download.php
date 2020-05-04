<?php
include("headers.php");
include("settings.php");

// Establish the real absolute path to the file
$file = realpath($docRoot . $iceRoot . str_replace("|", "/", $_GET['file']));
// If it doesn't exist, or doesn't start with the $docRoot, stop here
if (false === file_exists($file) || 0 !== strpos(str_replace("\\", "/", $file), $docRoot)) {
	die("<script>ICEcoder.message('Sorry, that file doesn\'t appear to exist');</script>");
}

if (true === file_exists($file)) {
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header('Content-Description: File Transfer');
    header("Content-Type: application/octet-stream");
    header('Content-Disposition: attachment; filename=' . basename($file));
    // header("Content-Transfer-Encoding: binary");
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
