<?php
$title = 'Albums';
require 'header.php';

$sql="INSERT INTO albums (artist_id, title, year) VALUES ((SELECT id FROM artists
WHERE name = '{$_GET['artistname']}'), '{$_GET['albumname']}', '{$_GET['year']}-01-01')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Album added";

require 'footer.php';
?>
