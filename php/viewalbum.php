<?php
$title = 'Album';
require 'header.php';

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

echo "</table><a href=\"/deltrack.php?albumid={$_GET['albumid']}\">Delete track</a> <a href=\"/addtrack.php?albumid={$_GET['albumid']}\">Add track</a>";
echo "  <a href=\"/addrelease.php?albumid={$_GET['albumid']}\">Add release</a>";

$result = mysqli_query($con,"SELECT * FROM releases WHERE album_id = '{$_GET['albumid']}'")
  or die('Query error: '.mysqli_error($con));

echo "<br />
      <h3>Releases</h3>
      <table border='1'>
      <tr>
      <th>Date</th><th>Description</th>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>{$row['year']}</td>";
  echo "<td>{$row['description']}</td>";
  if(loggedin())
    echo "<td> <a href=\"/php/addtocol.php?releaseid={$row['id']}\"> Add to collection </a> </td>";
  echo "</tr>";
}

require 'footer.php';
?>
 
