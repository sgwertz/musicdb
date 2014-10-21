<?php
$title = 'Albums';
require 'header.php';

$result = mysqli_query($con,"SELECT id, title, YEAR(year) AS year FROM albums ORDER BY year ASC") or die('Query error: '.mysqli_error($con));

echo "<table border='1'>
<tr>
<th>Title</th>
<th>Year</th>
</tr>";

$year = null;
while($row = mysqli_fetch_array($result)) {
  if($row['year'] != $year) {
    $year = $row['year'];
    echo "<tr><th colspan=\"2\">$year</th></tr>";
  }
  echo "<tr>";
  echo "<td><a href=\"viewalbum.php?albumid={$row['id']}\">{$row['title']}</a></td>";
  echo "<td>$year</td>";
  echo "</tr>";
}

echo "</table>";

require 'footer.php';
?>
