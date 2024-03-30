<?php
// Change this to your connection info.
$DATABASE_HOST = '10.35.232.176:3306';
$DATABASE_USER = 'k230243_dbowner';
$DATABASE_PASS = '2q02Ds2*z';
$DATABASE_NAME = 'k230243_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (!$con) {
	// If there is an error with the connection, stop the script and display the error.
	die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
else {
	//echo "Successfully connected";
}
?>