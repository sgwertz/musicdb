<?php
$con=mysqli_connect("localhost","root","","musicDB");
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$artist_id = mysqli_query($con,"SELECT id FROM artists WHERE name = 'artistname'");
mysqli_query($con,"DELETE FROM tracks WHERE artist_id = '$artist_id'");
mysqli_query($con,"DELETE FROM albums WHERE artist_id = '$artist_id'");
mysqli_query($con,"DELETE FROM artists WHERE artist_id = '$artist_id'");

mysqli_close($con);
?>
