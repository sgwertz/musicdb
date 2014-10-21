<?php
$title = 'Artists';
require 'php/header.php';
?>

<h1>Search Artists</h1>

<form id="searchArtist" method="get" action="php/searchartists.php">
  Artist name: <input type="text" name="artistname">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
