<?php
$title = 'Album';
require 'header.php';

mysqli_query($con,"DELETE FROM tracks WHERE album_id = (SELECT id FROM albums
WHERE title = '{$_GET['albumname']}')") or die('Query error: '.mysqli_error($con));
mysqli_query($con,"DELETE FROM albums WHERE title = '{$_GET['albumname']}'")
   or die('Query error: '.mysqli_error($con));

echo "Album deleted";

require 'footer.php';
?>
