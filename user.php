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
		<title>User Page - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="nav"></div>
		<div id="content">
			<?php
				if(!isset($_GET["id"])) die('<h1 style="text-align:center">Please <a href="/login">login</a> first!</h1>');

				$conn = new mysqli("localhost", "root", "", "schoolies");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}

				$result = $conn->query('SELECT * FROM users WHERE id = ' . $_GET["id"] . ';');
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo("Username: " . $row["username"] . "<br>");
						echo("Password: " . $row["password"] . "<br>");
						if($row["type"] == 1) {
							echo("User is an administrator" . "<br>");
						} else {
							echo("User is a general user" . "<br>");
						}
						if($row["email"] == null) {
							echo("E-Mail: None" . "<br>");
						} else {
							echo("E-Mail: " . $row["email"] . "<br>");
						}
						echo("ID: " . $_GET["id"] . "<br>");
					}
				}
			?>
		</div>
	</body>
</html>