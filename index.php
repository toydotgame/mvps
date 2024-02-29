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
			<p>Come to the Gold Coast! Yippee!!!</p>
			<?php
				$conn = new mysqli("localhost", "root", "", "gccc");
				if($conn->connect_error) { // catch
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}
				
				// Run query
				$result = $conn->query("SELECT * FROM events;");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					// echo() whatever; $row["colname"] u get it
					}
				} else {
					echo '<script>console.log("[ERROR] Failed to retrieve current events from database! Empty set.");</script>';
				}
			?>
			<div class="carousel">
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
				<a href=""><div class="carousel-item">
					<img src="https://placekitten.com/300/300">
					<h1>Item Title</h1>
					<p>Description lorem ipsum dolor sit amet</p>
				</div></a>
			</div>
			<br>
			<img src="https://placekitten.com/300/300" width="25%">
			<table>
				<tr><th>Col 1</th><th>Col 2</th></tr>
				<tr><td>Title</td><td>Value</td></tr>
				<tr><td>Title</td><td>Value</td></tr>
				<tr><td>Title</td><td>Value</td></tr>
				<tr><td>Title</td><td>Value</td></tr>
				<tr><td>Title</td><td>Value</td></tr>
			</table>
		</div></div>
		<div id="footer"><p>&copy; 2024 Gold Coast City Council</p></div>
	</body>
</html>
