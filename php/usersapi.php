<?php
session_start();

// Attempts to login and returns an error if it fails, otherwise returns false.
function doLogin($username, $password)
{
	global $con;

	$sql = 'SELECT id, name FROM users WHERE LOWER(name) = LOWER(\''.$username.'\') AND password = SHA2(\''.$password.'\', 256)';
	if(!($result = mysqli_query($con, $sql)))
		return 'Query error: '.mysqli_error($con);

	// Should only get one user returned.
	if(mysqli_num_rows($result) != 1)
		return 'Invalid login.';

	$_SESSION['user'] = mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	return false;
}

// Attempts to register a new user. Returns an error if it fails, otherwise
// returns false and logs in the new user.
function doRegistration($username, $password)
{
	global $con;

	if(empty($username) || empty($password))
		return 'Incomplete form.';

	$sql = 'INSERT INTO users (name, password) VALUES (\''.$username.'\', SHA2(\''.$password.'\', 256))';

	// Query failed, we can just assume that the username is in conflict for
	// this assignment.
	if(!mysqli_query($con, $sql))
		return 'Username taken.';

	// If logging in fails during registration, who knows what went wrong.
	if(doLogin($username, $password) !== false)
		return 'Registration failed.';
	return false;
}

// Returns true if the user is logged in.
function loggedin()
{
	return isset($_SESSION['user']) && is_array($_SESSION['user']);
}

// Returns user information if logged in.
function getuser()
{
	return isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
}

if(isset($_GET['logout']))
	unset($_SESSION['user']);

if(isset($_POST['login']))
	$loginError = doLogin($_POST['username'], $_POST['password']);
else
	$loginError = false;
if(isset($_POST['register']))
	$loginError = doRegistration($_POST['username'], $_POST['password']);
