<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql="INSERT INTO albums (artist_id, title, year) VALUES ((SELECT id FROM artists
WHERE name = '{$_GET['artistname']}'), '{$_GET['albumname']}', '{$_GET['year']}-01-01')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Album added";

mysqli_close($con);
?>
