<?php
$title = 'Albums';
require 'php/header.php';
?>

<h1>Delete An Album</h1>

<form id="delAlbum" method="get" action="/php/delalbum.php">
  Album name: <input type="text" name="albumname">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
