<?php
require('config.php');
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

//$stmt = $con->prepare('SELECT display, exp FROM user ORDER BY EXP DESC'); execute etc needed too
$result = $con->query('SELECT user.display,images.image, user.exp FROM user left join images on images.user = user.id ORDER BY EXP DESC'); 
?>
<html>
  <head>
    <link rel="stylesheet" href="../css/styles.css">
	<link rel="icon" type="image/x-icon" href="/images/favicon/favicon.ico">
	  	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	 <script src="../js/loader.js"></script>
	</head>
	<body>
		<?php include('utils/loader.php'); include ('utils/nav.php'); ?>
		<div class="wrapper leaderb">
		<table id="leaderboard">
			<tr> <th>Ranking</th> <th>Name</th><th>Level</th></tr>
		<?php

  while($row = $result->fetch_assoc()) {
	  foreach($result as $i => $row) {
		  	echo "<tr>	
					<td id='rank". $i+1 ."'>". $i+1 ."</td>	
					<td id='display". $i+1 ."'>" . $row["display"]. " </td>	
					<td id='exp". $i+1 ."'>" . $row["exp"]. "</td>	
				</tr>";
		 if ($i>=9) {
			  break;
		  }
	  }
    //echo "Name: " . $row["display"]. " - Name: " . $row["exp"]. "<br>";
break;
  }?>
			</table>
		</div>
	</body>
</html>
<?php
$conn->close();
?>