<html>
  <head>
    <link rel="stylesheet" href="../css/styles.css">
	<link rel="icon" type="image/x-icon" href="/images/favicon/favicon.ico">
	</head>
	<body >
	</body>
</html>
<?php
require('config.php');
session_start();

if (isset($_POST['login'])) {
	if ($stmt = $con->prepare('SELECT id, password, display FROM user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['LOGINUSER']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
		
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password,$display);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['LOGINPW'], $password)) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $display;
		$_SESSION['id'] = $id;
		header('Location: home.php');
	} else {
		// Incorrect password
		echo '<p class="test">Incorrect username and/or password!</p>';
	}
} else {
	// Incorrect username
	echo '<p class="test">Incorrect username and/or password!</p>';
}
	$stmt->close();
	}

}
else {
	if ($stmt = $con->prepare('SELECT id, password FROM user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['REGISTERUSER']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo '<p class="test">Username exists, please choose another!</p>';
	} else {
		if ($stmt = $con->prepare('INSERT INTO user (username, password, mail) VALUES (?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			$password = password_hash($_POST['REGISTERPW'], PASSWORD_DEFAULT);
			$stmt->bind_param('sss', $_POST['REGISTERUSER'], $password, $_POST['REGISTERMAIL']);
			$stmt->execute();
			echo '<p class="test">You have successfully registered! You can now login!</p>';
		} else {
			// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three 					fields.
			echo 'Could not prepare statement!';
		}
	}
	$stmt->close();
} else {
	// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
}
?>