<?php
$title = 'Albums';
require 'header.php';

$result = mysqli_query($con,"SELECT id, title, YEAR(year) AS year FROM albums ORDER BY id ASC");

echo "<table border='1'>
<tr>
<th>Title</th>
<th>Year</th>
</tr>";


while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td><a href=\"viewalbum.php?albumid={$row['id']}\">{$row['title']}</a></td>";
  echo "<td>" . $row['year'] . "</td>";
  echo "</tr>";
}

echo "</table>";

require 'footer.php';
?>
