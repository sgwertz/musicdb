<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql=mysqli_query($con, "UPDATE albums SET title = '{$_GET['correctName']}' WHERE title = '{$_GET['originalName']}'")
  or die('Query error: '.mysqli_error($con));

echo "Album modified";

mysqli_close($con);

?>
