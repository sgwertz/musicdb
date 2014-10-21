<?php
$title = 'Artists';
require 'header.php';

$result = mysqli_query($con,"SELECT * FROM artists ORDER BY id ASC");

while($row = mysqli_fetch_array($result)) {
  echo "<a href=\"viewalbumsbyArtist.php?artistid={$row['id']}\">{$row['name']}</a>";
  echo "<br>";
}

require 'footer.php';
?>
