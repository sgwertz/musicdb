<?php
$title = 'Albums';
require 'php/header.php';
?>

<h1>Search Albums</h1>

<form id="searchAlbums" method="get" action="/php/searchalbums.php">
  Album name: <input type="text" name="albumname">
  <input type="submit">
</form>


</body>
</html>
