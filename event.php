<!DOCTYPE html>

<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-02-29
	Event page.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/event.css">
		<title>Event - Gold Coast City Council</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="navbar"><div id="nav" class="card"></div></div>
		<div id="content"><div class="card">
			<?php
				if(is_null($_GET["id"])) {
					die("<h1>404</h1><p>The event you are looking for could not be found!</p>");
				}

				$conn = new mysqli("localhost", "root", "", "gccc");
				if($conn->connect_error) { // catch
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}
				
				$result = $conn->query("SELECT * FROM events WHERE id = " . $_GET["id"] . ";");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { // Should only run for 1 row but oh well
						echo('
							<img src="' . $row["img"] . '">
							<div id="textcontainer">
							<h1>' . $row["title"] . '</h1>
							<p><b>When:</b> ' . $row["time"] . '</p>
							<p><b>Where:</b> ' . $row["loc"] . '</p>
							<br>
							<p>' . $row["long_desc"] . '</p><br>
							<a href="form?id=' . $_GET["id"] . '"><div id="interestbutton">Interested?<br>Click Here</div></a>
							<br><br><br><br><br> <!-- very good way to make table display good-er -->
							</div>
						');
					}
				} else {
					echo '<script>console.log("[ERROR] Failed to retrieve current events from database! empty set.");</script>';
				}
			?>
			<table>
				<tr><th>Day:</th><th>Monday (32/12/2020)</th></tr>
				<tr><td>Humidity</td><td>65%</td></tr>
				<tr><td>Temperature</td><td>31 °C</td></tr>
				<tr><td>Wind Speed</td><td>14 km/h</td></tr>
				<tr><td>Precip. Chance</td><td>0%</td></tr>
				<tr><td>UV Index</td><td>12</td></tr>
			</table>
		</div></div>
		<div id="footer"><p>&copy; 2024 Gold Coast City Council</p></div>
	</body>
</html>
