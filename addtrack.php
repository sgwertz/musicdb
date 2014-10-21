<?php
$title = 'Tracks';
require 'php/header.php';
?>

<h1>Add A Track</h1>

<form id="addTrack" method="get" action="/php/addtrack.php">
  <input type="hidden" name="albumid" value="<?php echo $_GET['albumid']; ?>">
  Number: <input type="text" name="tracknum">
  Name: <input type="text" name="trackname">
  Length: <input type="text" name="tracklength">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
 
