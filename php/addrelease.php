<?php
$title = 'AddRelease';
require 'header.php';
$albumid = $_GET['albumid'];
$description = $_GET['description'];
$releasedate = $_GET['releasedate'];

$sql="INSERT INTO releases (album_id, description, year) VALUES ($albumid, '$description', $releasedate)";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Release added";

require 'footer.php';
?>
