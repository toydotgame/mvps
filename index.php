<!DOCTYPE html>
<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-05-01
	I honestly have no idea what kind of website I'm making.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/styles.css">
		<title>Home - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="nav"></div>
		<div id="content">
			<h1>Very Cool Website</h1>
			<?php
				$conn = new mysqli("localhost", "root", "", "schoolies");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}

				if(isset($_COOKIE["currentUser"])) { // 
					$result = $conn->query('SELECT * FROM users WHERE id = ' . $_COOKIE["currentUser"] . ';');
					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo('<p>Welome, ' . $row["username"] . '. Head over to the <a href="/chat">chat</a> or <a href="/map">Maps</a> pages to communicate with your friends!</p>');
						}
					}
				} else {
					echo('<p>Please <a href="/login">log in</a> in order to use the site!</p>');
				}
			?>
		</div>
	</body>
</html>