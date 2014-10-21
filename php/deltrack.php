<?php
$title = 'Tracks';
require 'header.php';

mysqli_query($con,"DELETE FROM tracks WHERE album_id = 
  {$_GET['albumid']} AND number = {$_GET['tracknum']}")
   or die('Query error: '.mysqli_error($con));

echo "Track deleted<br><br><a href=\"viewalbum.php?albumid={$_GET['albumid']}\">Return</a>";

require 'footer.php';
?>
 
