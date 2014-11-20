<?php
require 'header.php';

$uid = getuser()['id'];
$sql = "SELECT album_id, releases.id AS release_id, artist_id, description, artists.name AS name, albums.title AS title, YEAR(releases.year) AS year ".
       "FROM releases INNER JOIN albums ON albums.id = releases.album_id INNER JOIN artists ON artists.id = albums.artist_id ".
       "WHERE releases.id IN (SELECT release_id FROM collections WHERE owner_id = $uid) ORDER BY artists.name, releases.year ASC";
if(!($result = mysqli_query($con, $sql)))
	die('Query error: '.mysqli_error($con));

$last_artistid = -1;
while(($row = mysqli_fetch_assoc($result)))
{
	if($last_artistid != $row['artist_id'])
	{
		// Print the name of the artist when it changes over (artists are sorted)
		echo "<h1><a href=\"viewalbumsbyArtist.php?artistid={$row['artist_id']}\">{$row['name']}</a></h1>";
		$last_artistid = $row['artist_id'];

		// Grab the completion percentage.
		$sql = "SELECT * FROM ".
		       "(SELECT COUNT(DISTINCT album_id) AS have FROM releases WHERE album_id IN (SELECT id FROM albums WHERE artist_id = {$row['artist_id']}) AND id IN (SELECT release_id FROM collections WHERE owner_id = $uid)) a,".
		       "(SELECT COUNT(*) AS total FROM albums WHERE artist_id = {$row['artist_id']}) b";
		if(!($result2 = mysqli_query($con, $sql)))
			die('Query error: '.mysqli_error($con));

		$stats = mysqli_fetch_object($result2);
		mysqli_free_result($result2);

		echo "<p>Completion: {$stats->have}/{$stats->total} (".floor($stats->have*100/$stats->total).'%)</p>';
	}

	echo "<h2>{$row['year']} - <a href=\"viewalbum.php?albumid={$row['album_id']}\">{$row['title']}</a></h2>";

	$sql = "SELECT id, description FROM releases WHERE album_id = {$row['album_id']} AND id NOT IN (SELECT release_id FROM collections WHERE owner_id = $uid)";
	if(!($result2 = mysqli_query($con, $sql)))
		die('Query error: '.mysqli_error($con));

	if(mysqli_num_rows($result2))
	{
		echo "<p>You need:</p><ul>";
		while(($row = mysqli_fetch_assoc($result2)))
		{
			echo "<li>{$row['description']}</li>";
		}
		echo "</ul>";
	}
	else
	{
		echo "<p>You have all releases!</p>";
	}
	mysqli_free_result($result2);
}

mysqli_free_result($result);

require 'footer.php';
