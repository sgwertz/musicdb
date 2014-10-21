<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$albums = mysqli_query($con,"SELECT * FROM albums WHERE title LIKE
'%{$_GET['albumname']}%'") or die('Query error: '.mysqli_error($con));

echo "<table border='1'>
<tr>
<th>Name</th>
</tr>";


while($row = mysqli_fetch_array($albums)) {
  echo "<tr>";
  echo "<td><a href=\"viewalbum.php?albumid={$row['id']}\">{$row['title']}</a></td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
