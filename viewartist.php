<?php
$con=mysqli_connect("localhost","root","","musicDB");
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT artistname FROM Artist");

//Show albums?
while($artist = mysqli_fetch_array($result)) {
  echo $row['artistname'];
  echo "<br>";
}

mysqli_close($con);
?>
