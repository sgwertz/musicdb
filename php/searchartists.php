<?php
$con=mysqli_connect("localhost","root","","musicDB");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$albums = mysqli_query($con,"SELECT title, year FROM albums WHERE artist_id =
(SELECT id FROM artists WHERE name = 'artistname')");

echo "<table border='1'>
<tr>
<th>Title</th>
<th>Year</th>
</tr>";


while($row = mysqli_fetch_array($albums)) {
  echo "<tr>";
  echo "<td>" . $row['title'] . "</td>";
  echo "<td>" . $row['year'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
