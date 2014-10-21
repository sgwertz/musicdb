<?php
$title = 'Artists';
require 'php/header.php';
?>

<h1>Delete An Artist</h1>

<form id="delArtist" method="get" action="/php/delartist.php">
  Artist name: <input type="text" name="artistname">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
