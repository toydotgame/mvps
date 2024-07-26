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
			<script type="module">
				import { LogInUser } from "/cookieman.js";

				LogInUser(window.location.search.substr(1).split("=")[1]);
			</script>
			<?php
				if(!isset($_GET["id"])) die('<h1 style="text-align:center">Please <a href="/login">login</a> first!</h1>');

				$conn = new mysqli("localhost", "root", "", "schoolies");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}

				$result = $conn->query('SELECT * FROM users WHERE id = ' . $_GET["id"] . ';');
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$conn->query('INSERT INTO chat (message, user) VALUES ("User ' . $row["username"] . ' has logged in.", 1);');
						
						if($row["type"] != 1) { //Normal user						
							echo('<h1 style="text-align:center">Welcome, ' . $row["username"] . '. Login successful, you will be redirected in 5 seconds.</h1>
							<p style="text-align:center"><a href="/">Impatient?</a></p>');
							echo('<script>// sleep time expects milliseconds
							function sleep (time) {
							return new Promise((resolve) => setTimeout(resolve, time));
							}

							// Usage!
							sleep(5000).then(() => {
								window.location.href = "/";
							});</script>');
						} else {
							echo 'Welcome, admin!';
							echo '<ul style="margin-left:4em">
							<li><a href>Chat</a></li>
							<li><a href>Maps</a></li>
							<li><a href>Emergency Button</a></li>
							</ul><br>';
							echo '<h1>User management page</h1>
								<table>
								<tr><td>Username</td><td><input></td></tr>
								<tr><td>E-Mail</td><td><input></td></tr>
								<tr><td>Password</td><td><input type="password"></td></tr>
								<tr><td colspan="2"><button style="margin:0 auto">Submit</button></td></tr>
								</table>';
						}
					}
				}
			?>
		</div>
	</body>
</html>