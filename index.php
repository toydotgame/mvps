<!DOCTYPE html>

<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-02-15
	What's On page.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/whats-on.css">
		<title>What's On - Gold Coast City Council</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="navbar"><div id="nav" class="card"></div></div>
		<div id="content"><div class="card">
			<h1>What's On</h1>
			<p>Some say we like to see ourselves as the main event, but really, we do it all for you! High-energy stage show sound good? How about beach cinema or symphony under the stars? If sport's more your thing, why not check out a NRL or AFL game? Or for lovers of low-key, get into one of the many grassroots arts and food festivals. Check out the latest events on Gold Coast below and Stay & Play for the ultimate getaway!</p>
			<?php
				$conn = new mysqli("localhost", "root", "", "gccc");
				if($conn->connect_error) { // catch
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}
				
				// Hardcoded HTML categories that correspond to the array ID numbers in DB (DB index 1-5, PHP index 0-4)
				$categories = array("Featured", "Food & Drink", "Entertainment", "Sports", "Arts/Music");
				for($i = 0; $i <= 4; $i++) {
					echo ('<h2>' . $categories[$i] . '</h2><div class="carousel">');
					// Run query
					$result = $conn->query("SELECT * FROM events WHERE category = " . $i + 1 . ";"); // convert PHP for() loop index to DB index
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo('
								<a href="event?id=' . $row["id"] . '"><div class="carousel-item">
									<img src="' . $row["img"] . '">
									<h1>' . $row["title"] . '</h1>
									<p>' . $row["short_desc"] . '</p>
								</div></a>
							'); // Create HTML groups with relevant information about a given event (row)
						}
					} else {
						echo '<script>console.log("[ERROR] Failed to retrieve current events from database! Empty set.");</script>';
					}
					echo('</div>');
				}
			?>
		</div></div>
		<div id="footer">
		<p>The weather information on this website is sourced from the BOM. Click <a href="https://www.bom.gov.au/other/disclaimer.shtml" style="color:#33e">here</a> to see the disclaimer.</p>	
		<p>All rights are reserved by the respective copyright holders of the text and images on this page. Click <a href="https://www.goldcoast.qld.gov.au/disclaimer-and-copyright.html" style="color:#33e">here</a> to see the disclaimer.</p>	
		<p>&copy; 2024 Gold Coast City Council</p></div>
	</body>
</html>
