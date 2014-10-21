<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con,"DELETE FROM tracks WHERE album_id = (SELECT id FROM albums
WHERE title = '{$_GET['albumname']}')") or die('Query error: '.mysqli_error($con));
mysqli_query($con,"DELETE FROM albums WHERE title = '{$_GET['albumname']}'")
   or die('Query error: '.mysqli_error($con));

echo "Album deleted";

mysqli_close($con);
?>
