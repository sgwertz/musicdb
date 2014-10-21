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
</head>
<body>
