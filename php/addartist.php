<?php
$title = 'Artist';
require 'header.php';

// escape variables for security
$artistname = mysqli_real_escape_string($con, $_POST['artistname']);

$sql="INSERT INTO Artists (name) VALUES ('$artistname')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Artist added";

require 'footer.php';
?>
