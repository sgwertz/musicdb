<?php
require dirname(__FILE__).'/../sql/config.php';
$con=mysqli_connect($dbserv,$dbuser,$dbpass,$dbbase);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo isset($title) ? $title : 'MuzakDB'; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
html, body { padding: 0; margin: 0; }

.head
{
	width: 100%;
	display: block;
	background-color: #EEEEEE;
	border-bottom: #7F7F7F 1px solid;
	height: 50px;
}
.head h1
{
	margin: 0px;
	padding: 5px;
	float: right;
}
.head ul
{
	margin: 0;
	padding: 0;
	padding-left: 20px;
	height: 100%;
}
.head ul li
{
	list-style: none;
	display: inline;
	height: 100%;
	line-height: 50px;
}

.content
{
	padding: 1em;
}
</style>
</head>
<body>
<div class="head">
<h1>MuzakDB</h1>
<ul>
	<li><a href="/artists.php">Artists</a></li>
	<li><a href="/albums.php">Albums</a></li>
</ul>
</div>
<div class="content">
