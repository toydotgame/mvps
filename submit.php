<!DOCTYPE html>

<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-03-01
	Form post-submission page.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/form.css">
		<title>Form Submission - Gold Coast City Council</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="navbar"><div id="nav" class="card"></div></div>
		<div id="content"><div class="card">
			<?php
				if(is_null($_POST["name"])) {
					die("<h1>400</h1><p>Sorry, your form could not be submitted!</p>");
				}

				$conn = new mysqli("localhost", "root", "", "gccc");
				if($conn->connect_error) { // catch
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}
				
				// Insert POST request variables directly into `users`:
				$result = $conn->query('INSERT INTO users VALUES (NULL, "' . $_POST["name"] . '", "' . $_POST["email"] . '", "' . preg_replace('/\s+/', '', $_POST["phone"]) . '", ' . $_POST["id"] . ');');
				if($result == 1) {
					echo ('<h1 style="text-align:center">Submission Successful!</h1>');
				} else {
					die("<h1>400</h1><p>Sorry, your form could not be submitted!</p>");
				}
			?>		
		</div></div>
		<div id="footer"><p>&copy; 2024 Gold Coast City Council</p></div>
	</body>
</html>
