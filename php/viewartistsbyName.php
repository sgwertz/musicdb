<?php
$title = 'Artists';
require 'header.php';

$result = mysqli_query($con,"SELECT * FROM artists ORDER BY name ASC");

$char = '';
while($row = mysqli_fetch_array($result)) {
  if(strtoupper($row['name'][0]) != $char) {
    $char = strtoupper($row['name'][0]);
    echo "<h2>$char</h2>";
  }
  echo "<a href=\"viewalbumsbyArtist.php?artistid={$row['id']}\">{$row['name']}</a>";
  echo "<br>";
}

require 'footer.php';
?>
