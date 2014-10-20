<?php
require 'sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$artistID = mysqli_query($con,"SELECT id FROM artist WHERE name = 'artistname'");
$albumName = mysqli_real_escape_string($con, $_POST['albumname']);
$year = mysqli_real_escape_string($con, $_POST['year']);

$sql="INSERT INTO albums VALUES ($artistID, $albumname, $year);

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Album added";

mysqli_close($con);
?>
