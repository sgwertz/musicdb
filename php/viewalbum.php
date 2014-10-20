<?php
require '../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Open connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT count(distinct(artist_id)) AS numartists
FROM tracks WHERE album_id = {$_GET['albumid']}")
  or die('Query error: '.mysqli_error($con));
$row = mysqli_fetch_array($result);
$numartists = $row['numartists'];

if($numartists == 1) {
  $result = mysqli_query($con,"SELECT * FROM tracks WHERE album_id =
  '{$_GET['albumid']}' ORDER BY number ASC")
    or die('Query error: '.mysqli_error($con));
}
else {
  $result = mysqli_query($con,"SELECT * FROM tracks INNER JOIN artists ON 
  artists.id = tracks.artist_id WHERE album_id =
  '{$_GET['albumid']}' ORDER BY number ASC")
    or die('Query error: '.mysqli_error($con));
}

echo "<table border='1'>
<tr>
<th>#</th>";
if($numartists != 1)
  echo "<th>Artist</th>";
echo "<th>Title</th>
<th>Length</th>
</tr>";


while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>{$row['number']}</td>";
  if($numartists != 1) {
    echo "<td><a href=\"viewalbumsbyArtist.php?artistid={$row['artist_id']}\">{$row['name']}</a></td>";
  }
  echo "<td>{$row['title']}</td>";
  echo "<td>{$row['length']}</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
 
