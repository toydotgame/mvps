<!DOCTYPE html>
<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-05-01
	I honestly have no idea what kind of website I'm making.
-->

<?php
	if(isset($_GET["confirm"]) && $_GET["confirm"] == "true") {
		$conn = new mysqli("localhost", "root", "", "schoolies");
		if($conn->connect_error) {
			die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
		}

		$result = $conn->query('INSERT INTO chat (message, user) VALUES ("User jenson is in an emergency at location <a href=\"/map\">-33.8594, 151.17158</a>!", 1);');

		echo('<script>window.location.href = "/chat";</script>');
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/styles.css">
		<title>Template - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="nav"></div>
		<div id="content">
			<script>
				function checkSlider(e) {
					var slider = document.querySelector("#slider");
					if(slider.value == 100) {
						slider.disabled = "true";
						window.location.href += "?confirm=true";
					}
				}
			</script>
			<div id="emergencycont">
				<div id="middlecont">
					<p>Slide to confirm your emergency alert.</p><br>
					<input id="slider" onchange="checkSlider(event)" type="range" value="0">
				</div>
			</div>
		</div>
	</body>
</html>