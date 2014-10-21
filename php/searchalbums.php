<?php
$title = 'Albums';
require 'header.php';

$albums = mysqli_query($con,"SELECT * FROM albums WHERE title LIKE
'%{$_GET['albumname']}%'") or die('Query error: '.mysqli_error($con));

echo "<table border='1'>
<tr>
<th>Name</th>
</tr>";


while($row = mysqli_fetch_array($albums)) {
  echo "<tr>";
  echo "<td><a href=\"viewalbum.php?albumid={$row['id']}\">{$row['title']}</a></td>";
  echo "</tr>";
}

echo "</table>";

require 'footer.php';
?>
