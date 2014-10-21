<?php
$title = 'Artists';
require 'php/header.php';
?>

<h1>Add An Artists</h1>

<form id="addArtist" method="post" action="/php/addartist.php">
  Artist name: <input type="text" name="artistname">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
