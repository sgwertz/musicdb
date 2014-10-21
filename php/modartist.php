<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql=mysqli_query($con, "UPDATE artists SET name = {$_GET['correctName']} WHERE name = {$_GET['originalName']}");

echo "Artist modified";

mysqli_close($con);

?>
