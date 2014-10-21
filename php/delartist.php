<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con,"DELETE FROM tracks WHERE artist_id = (SELECT id FROM artists WHERE name = '{$_GET['artistname']}')") or die('Query error: '.mysqli_error($con));
mysqli_query($con,"DELETE FROM albums WHERE artist_id = (SELECT id FROM artists WHERE name = '{$_GET['artistname']}')") or die('Query error: '.mysqli_error($con));
mysqli_query($con,"DELETE FROM artists WHERE name = '{$_GET['artistname']}'") or die('Query error: '.mysqli_error($con)) or die('Query error: '.mysqli_error($con));

echo "Artist deleted";

mysqli_close($con);
?>
