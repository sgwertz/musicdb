<?php
$title = 'Add to Collection';
require 'header.php';

$release = $_GET['releaseid'];
$user = getuser();

$sql="INSERT INTO collections (owner_id, release_id) VALUES ({$user['id']}, $release)";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "Release added to Collection";

require 'footer.php';
?>