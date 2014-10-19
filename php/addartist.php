<?php
$con=mysqli_connect("localhost","root","","musicDB");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$artistname = mysqli_real_escape_string($con, $_POST['artistname']);

$sql="INSERT INTO Artists (name) VALUES ('$artistname')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Artist added";

mysqli_close($con);
?>
