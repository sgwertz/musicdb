<?php
$title = 'Artists';
require 'header.php';

$sql=mysqli_query($con, "UPDATE artists SET name = '{$_GET['correctName']}' WHERE name = '{$_GET['originalName']}'")
  or die('Query error: '.mysqli_error($con));

echo "Artist modified";

require 'footer.php';

?>
