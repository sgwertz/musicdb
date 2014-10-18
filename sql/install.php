<?php
// Nothing particularly optimized or secure here, just churned out so that this
// can be setup on multiple servers easily.

if(file_exists('config.php'))
	include 'config.php';
else
{
	$dbserv = null;
	$dbuser = null;
	$dbpass = null;
	$dbbase = null;
}

session_start();

function try_connect()
{
	global $dbserv, $dbuser, $dbpass, $dbbase;
	$ret = new mysqli($dbserv, $dbuser, $dbpass, $dbbase);
	if($ret->connect_errno)
		die('Failed to connect to database: '.$ret->error);
	return $ret;
}

// Attempts to execute an SQL file (with limitations). Since we don't have
// infinite time to run our script, we need to break large files down into
// multiple segments. We do this with a session and telling the browser to
// refresh the page.
function execute_script($conn, $file, $skip=0)
{
	$queries = explode(';', file_get_contents($file));
	$count = 0;
	$toskip = $skip;
	foreach($queries as &$query)
	{
		if($toskip > 0)
		{
			--$toskip;
			continue;
		}

		$query = trim($query);
		if(empty($query))
			continue;

		if($result = $conn->query($query))
		{
			if(is_object($result))
				$result->free();
		}
		else
		{
			unset($_SESSION['execute']);
			die('Could not execute the SQL query: '.$conn->error);
		}

		if(++$count >= 2000)
		{
			$_SESSION['execute'] = array('file' => $file, 'skip' => $skip+$count);
			die('<html><head><meta http-equiv="refresh" content="1"></head><body>Continuing execution... Please wait.</body></html>');
		}
	}
	unset($_SESSION['execute']);
}

// Genreate the config.php file with the database parameters.
if(isset($_POST['dbserv'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbbase']))
{
	if($_POST['dbserv'] != $dbserv || $_POST['dbuser'] != $dbuser || $_POST['dbpass'] != $dbpass || $_POST['dbbase'] != $dbbase)
	{
		$conf = "<?php\n";
		foreach(array('dbserv', 'dbuser', 'dbpass', 'dbbase') as $key)
			$conf .= "\$$key='".addslashes($_POST[$key])."';\n";
		file_put_contents('config.php', $conf);
		include 'config.php';
	}
}

// Execute next segment
if(isset($_SESSION['execute']))
{
	$mysql = try_connect();
	execute_script($mysql, $_SESSION['execute']['file'], $_SESSION['execute']['skip']);
	$mysql->close();
}

// Do a database schema format.
if(isset($_POST['format']))
{
	$mysql = try_connect();
	execute_script($mysql, 'schema.sql');
	$mysql->close();
}

// Insert sample data.
if(isset($_POST['sample']))
{
	$mysql = try_connect();
	execute_script($mysql, 'sampledata.sql');
	$mysql->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Installer script</title>
<style type="text/css">
form
{
	width: 20em;
	display: block;
	margin: 10em auto;
}
label
{
	float: left;
	clear: left;
}
#dbserv, #dbuser, #dbpass, #dbbase
{
	float: right;
	clear: right;
}
</style>
</head>
<body>
<form method="post" action="?">
<fieldset>
<legend>Database</legend>
<label for="dbserv">Server:</label> <input type="text" id="dbserv" name="dbserv" value="<?php echo $dbserv; ?>" />
<label for="dbuser">Username:</label> <input type="text" id="dbuser" name="dbuser" value="<?php echo $dbuser; ?>" />
<label for="dbpass">Password:</label> <input type="text" id="dbpass" name="dbpass" value="<?php echo $dbpass; ?>" />
<label for="dbbase">Database:</label> <input type="text" id="dbbase" name="dbbase" value="<?php echo $dbbase; ?>" />
<div style="clear: both;float: right;width: 100%;text-align: center">
<input type="submit" name="format" value="Format" /> <input type="submit" name="sample" value="sample data" />
</div>
</fieldset>
</form>
</body>
</html>
