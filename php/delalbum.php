<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con,"DELETE FROM tracks WHERE album_id = (SELECT id FROM albums
WHERE title = 'albumname')");
mysqli_query($con,"DELETE FROM albums WHERE title = 'albumname'");

echo "Album deleted";

mysqli_close($con);
?>
