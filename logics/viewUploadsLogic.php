<?php
$vicID = isset($_GET['vicid']) ? $utils->sanitize($_GET['vicid']) : '';
$blacklist = array('..', '.', "index.php", ".htaccess");

$files = null;

if (file_exists("upload/$vicID")) {
    try {
        $files = scandir("upload/$vicID");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}
