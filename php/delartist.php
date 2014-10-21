<?php
$title = 'Artist';
require 'header.php';

mysqli_query($con,"DELETE FROM tracks WHERE artist_id = (SELECT id FROM artists WHERE name = '{$_GET['artistname']}')") or die('Query error: '.mysqli_error($con));
mysqli_query($con,"DELETE FROM albums WHERE artist_id = (SELECT id FROM artists WHERE name = '{$_GET['artistname']}')") or die('Query error: '.mysqli_error($con));
mysqli_query($con,"DELETE FROM artists WHERE name = '{$_GET['artistname']}'") or die('Query error: '.mysqli_error($con)) or die('Query error: '.mysqli_error($con));

echo "Artist deleted";

require 'footer.php';
?>
