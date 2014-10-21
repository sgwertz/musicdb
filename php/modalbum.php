<?php
$title = 'Albums';
require 'header.php';

$sql=mysqli_query($con, "UPDATE albums SET title = '{$_GET['correctName']}' WHERE title = '{$_GET['originalName']}'")
  or die('Query error: '.mysqli_error($con));

echo "Album modified";

require 'footer.php';

?>
