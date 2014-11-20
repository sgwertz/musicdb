<?php
require 'header.php';

$uid = getuser()['id'];

// Handling deletes/adds here for now.
if(isset($_GET['delete']))
{
	$sql = "DELETE FROM collections WHERE owner_id = $uid AND release_id IN (SELECT id FROM releases WHERE album_id = {$_GET['delete']})";
	if(!mysqli_query($con, $sql))
		die('Query error: '.mysqli_error($con));
}
if(isset($_GET['add']))
{
	$sql = "INSERT INTO collections (owner_id, release_id) VALUES ($uid, (SELECT id FROM releases WHERE album_id IN (SELECT id FROM albums WHERE title = '{$_GET['album']}' AND artist_id = (SELECT id FROM artists WHERE name = '{$_GET['artist']}'))))";
	if(!mysqli_query($con, $sql))
		die('Query error: '.mysqli_error($con));
}

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
		if($last_artistid != -1)
			echo "</fieldset>";
		// Print the name of the artist when it changes over (artists are sorted)
		echo "<fieldset><legend><h1><a href=\"viewalbumsbyArtist.php?artistid={$row['artist_id']}\">{$row['name']}</a></h1></legend>";
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

		// Rarities (various artists tracks)
		$sql = "SELECT album_id, release_id, number, tracks.title AS title, length, albums.title AS album_title, release_id IN (SELECT release_id FROM collections WHERE owner_id = $uid) AS have FROM tracks INNER JOIN albums ON album_id = albums.id WHERE tracks.artist_id = {$row['artist_id']} AND album_id IN (SELECT id FROM albums WHERE artist_id = 1)";
		if(!($result2 = mysqli_query($con, $sql)))
			die('Query error: '.mysqli_error($con));
		if(mysqli_num_rows($result2))
		{
			echo "<p>Rarities:</p><table><tr><th>Album</th><th>Title</th><th>Length</th></tr>";
			while(($r = mysqli_fetch_assoc($result2)))
			{
				if($r['have'])
					echo "<tr style=\"background-color: #AAFFAA\">";
				else
					echo "<tr>";
				echo "<td><a href=\"viewalbum.php?albumid={$r['album_id']}\">{$r['album_title']}</a></td><td>{$r['title']}</td><td>{$r['length']}</tr>";
			}
			echo "</table>";
		}
		mysqli_free_result($result2);
	}

	echo "<h2>{$row['year']} - <a href=\"viewalbum.php?albumid={$row['album_id']}\">{$row['title']}</a> <a href=\"?delete={$row['album_id']}\" style=\"font-size: 50%\">[delete]</a></h2>";

	$sql = "SELECT id, description FROM releases WHERE album_id = {$row['album_id']} AND id NOT IN (SELECT release_id FROM collections WHERE owner_id = $uid)";
	if(!($result2 = mysqli_query($con, $sql)))
		die('Query error: '.mysqli_error($con));

	if(mysqli_num_rows($result2))
	{
		echo "<p>You need:</p><ul>";
		while(($r = mysqli_fetch_assoc($result2)))
		{
			echo "<li>{$r['description']}</li>";
		}
		echo "</ul>";
	}
	else
	{
		echo "<p>You have all releases!</p>";
	}
	mysqli_free_result($result2);
}
if($last_artistid != -1)
	echo "</fieldset>";

mysqli_free_result($result);

?>
<form method="get" action="#">
Artist: <input type="text" name="artist" />
Album: <input type="text" name="album" />
<input type="submit" value="Add" name="add" />
</form>
<?php
require 'footer.php';
