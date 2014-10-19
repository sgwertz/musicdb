<?php
$con=mysqli_connect("localhost","root","","musicDB");
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM albums ORDER BY id ASC");

echo "<table border='1'>
<tr>
<th>Title</th>
<th>Year</th>
</tr>";


while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['title'] . "</td>";
  echo "<td>" . $row['year'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
