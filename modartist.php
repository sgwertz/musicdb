<?php
$title = 'Artist';
require 'php/header.php';
?>

<h1>Modify Artist</h1>
-Please select the artist name and then below insert the corrected name-

<form id="modArtist" method="get" action="/php/modartist.php">
  Artist name: <input type="text" name="originalName">
  Corrected name: <input type="text" name="correctName">
  <input type="submit">
</form>


<?php
require 'php/footer.php';
