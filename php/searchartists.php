<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$albums = mysqli_query($con,"SELECT id, name FROM artists WHERE name LIKE
'%{$_GET['artistname']}%' ORDER BY name ASC") or die('Query error: '.mysqli_error($con));

echo "<table border='1'>
<tr>
<th>Name</th>
</tr>";


while($row = mysqli_fetch_array($albums)) {
  echo "<tr>";
  echo "<td><a href=\"viewalbumsbyArtist.php?artistid={$row['id']}\">{$row['name']}</a></td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
