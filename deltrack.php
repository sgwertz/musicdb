<?php
$title = 'Tracks';
require 'php/header.php';
?>

<h1>Delete A Track</h1>

<form id="delTrack" method="get" action="/php/deltrack.php">
  <input type="hidden" name="albumid" value="<?php echo $_GET['albumid']; ?>">
  Track number: <input type="text" name="tracknum">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
 
