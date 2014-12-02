<?php
$title = 'Releases';
require 'php/header.php';
?>

<h1>Add A Release</h1>

<form id="addRelease" method="get" action="/php/addrelease.php">
  Description: <textarea name="description" id="description"></textarea>
  Release Date: <input type="text" name="releasedate">
  <input type="hidden" name="albumid" value="<?php echo $_GET['albumid']; ?>">
  <input type="submit">
</form>

<?php
require 'php/footer.php';
