<?php
$title = 'Albums';
require 'php/header.php';
?>

<h1>Add An Album</h1>

<form id="addAlbum" method="get" action="/php/addalbum.php">
  Artist name: <input type="text" name="artistname">
  Album name: <input type="text" name="albumname">
  Year: <input type="text" name="year">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
