<?php
$con=mysqli_connect("localhost","root","","musicDB");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT id FROM Artist WHERE name = 'artistname'");

  echo $row['name'];
  echo "<br>";


mysqli_close($con);
?>
