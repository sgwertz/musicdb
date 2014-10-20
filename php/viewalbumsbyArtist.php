<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM albums WHERE artist_id =
{$_GET['artistid']} OR id IN (SELECT album_id AS id FROM tracks WHERE
artist_id = {$_GET['artistid']}) ORDER BY year ASC")
  or die('Query error: '.mysqli_error($con));

echo "<table border='1'>
<tr>
<th>Title</th>
<th>Year</th>
</tr>";


while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td><a href=\"viewalbum.php?albumid={$row['id']}\">{$row['title']}</a></td>";
  echo "<td>{$row['year']}</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
 
