<?php
$title = 'Album';
require 'php/header.php';
?>

<h1>Modify Album</h1>
-Please select the album name and then below insert the corrected name-

<form id="modAlbum" method="get" action="/php/modalbum.php">
  Album name: <input type="text" name="originalName">
  Corrected name: <input type="text" name="correctName">
  <input type="submit">
</form>


<?php
require 'php/footer.php';
