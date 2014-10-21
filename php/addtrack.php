<?php
$title = 'Tracks';
require 'header.php';

mysqli_query($con, "INSERT INTO tracks (album_id, artist_id, number, title, length) VALUES
({$_GET['albumid']},(SELECT artist_id FROM albums WHERE id = {$_GET['albumid']}),{$_GET['tracknum']},'{$_GET['trackname']}','{$_GET['tracklength']}')")
  or die('Query error: '.mysqli_error($con));

echo "Track added<br><br><a href=\"viewalbum.php?albumid={$_GET['albumid']}\">Return</a>";

require 'footer.php';
?>
 
