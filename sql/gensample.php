<?php
// Scans my music collection to generate sample data. Not really part of the
// project, but it should be helpful.
//
// Only scans FLAC files.

define('MUSIC_DIR', '/media/Music');

$data = array('Various Artists' => array('id' => 1, 'albums' => array()));
$artistid = 2; // 1 = various artists
$albumid = 1;
$trackid = 1;
$releaseid = 1;

function escape($str)
{
	return str_replace(array('\'', ';'), array('\'\'', ''), $str);
}

function handleFile($file)
{
	global $data, $artistid, $albumid, $releaseid, $trackid;

	$isVA = strpos($file, MUSIC_DIR.'/Various') === 0;

	$cmdfile = "\"$file\"";
	$out = shell_exec('metaflac --list --block-type=VORBIS_COMMENT '.$cmdfile);
	$lengthinfo = explode("\n", shell_exec('metaflac --show-total-samples --show-sample-rate '.$cmdfile));
	$length = $lengthinfo[0]/$lengthinfo[1];
	$length = (int)((int)$length/3600).':'.(int)(((int)$length%3600)/60).':'.((int)$length%60);

	$meta = array();
	preg_match_all('/    comment\[[0-9]+\]: ([A-Z]+)=(.*)/', $out, $vorbis);
	for($i = 0;$i < count($vorbis[1]);++$i)
		$meta[$vorbis[1][$i]] = $vorbis[2][$i];

	if(!isset($meta['ARTIST']) || !isset($meta['ALBUM']) || !isset($meta['TITLE']))
		return;

	if(isset($meta['DATE']))
		$meta['YEAR'] = $meta['DATE'];

	if(!isset($data[$meta['ARTIST']]))
	{
		$data[$meta['ARTIST']] = array('id' => $artistid++, 'albums' => array());
		echo 'INSERT INTO artists (name) VALUES (\''.escape($meta['ARTIST'])."');\n";
	}

	$albumArtist = $isVA ? 'Various Artists' : $meta['ARTIST']; 
	if(!isset($data[$albumArtist]['albums'][$meta['ALBUM']]))
	{
		$data[$albumArtist]['albums'][$meta['ALBUM']] = array('id' => $albumid++, 'rid' => $releaseid++, 'tracks' => array());
		$date = isset($meta['YEAR']) && !empty($meta['YEAR']) ? '\''.$meta['YEAR'].'-01-01\'' : 'NULL';
		echo 'INSERT INTO albums (artist_id, title, year) VALUES ('.$data[$albumArtist]['id'].', \''.escape($meta['ALBUM']).'\', '.$date.");\n";
		echo 'INSERT INTO releases (album_id, description, year) VALUES ('.$data[$albumArtist]['albums'][$meta['ALBUM']]['id'].', \'Standard CD\', '.$date.");\n";
	}
	$data[$meta['ARTIST']]['albums'][$meta['ALBUM']]['tracks'][$meta['TRACKNUMBER'].$meta['TITLE']] = $trackid++;
	echo 'INSERT INTO tracks (artist_id, album_id, release_id, number, title, length) VALUES ('.$data[$meta['ARTIST']]['id'].', '.$data[$albumArtist]['albums'][$meta['ALBUM']]['id'].', '.$data[$albumArtist]['albums'][$meta['ALBUM']]['rid'].', '.(int)$meta['TRACKNUMBER'].', \''.escape($meta['TITLE']).'\', \''.$length."');\n";
}

function scan($dir)
{
	$handle = opendir($dir);
	while(($file = readdir($handle)) !== false)
	{
		if($file[0] == '.')
			continue;

		$fname = $dir.'/'.$file;
		if(is_dir($fname))
			scan($fname);
		else
		{
			if(strpos($file, '.flac') == strlen($file)-5)
				handleFile($fname);
		}
	}
}

scan(MUSIC_DIR);
