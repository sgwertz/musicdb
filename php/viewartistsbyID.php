<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM artists ORDER BY id ASC");

while($row = mysqli_fetch_array($result)) {
  echo $row['name'];
  echo "<br>";
}

mysqli_close($con);
?>
