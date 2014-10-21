<?php
$title = 'Artists';
require 'php/header.php';
?>

<h1>Search Artists</h1>

<form id="searchArtist" method="get" action="?">
  Artist name: <input type="text" name="artistname">
  <input type="submit">
</form>

<?php
require 'php/searchartists.php';
require 'php/footer.php';
?>
