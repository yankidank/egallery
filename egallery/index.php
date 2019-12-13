<?php
// Reserving the index.php file for future use. Temporary redirect to upload page.
$subdir = $_SERVER["REQUEST_URI"];
$subdirectory = str_replace($directory."/index.php", "", $subdir);
header("Location: ".$subdirectory."upload.php",TRUE,307);
?>