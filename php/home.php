<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
	}

	//header('Location: profile.php');
?>

<html>
  <head>
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="icon" type="image/x-icon" href="/images/favicon/favicon.ico">
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	  	<script src="../js/loader.js"></script>
	</head>
	<body >
		<?php include('utils/loader.php'); include ('utils/nav.php'); ?>
		<div class="wrapper wb">
			<p id="wb">Welcome back, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p>
		</div>
	</body>
</html>
