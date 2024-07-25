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
		<title>Map - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZym0_hNyNli3XJ1ygz4pToB5YvoatDzg"></script>
	</head>
	<body>
		<div id="nav"></div>
		<div id="content">
			<div id="map" style="width: 100%; height: 400px;"></div>
			<script>var locations = "[['', 0, 0, 0]]";</script>
			<?php
				$conn = new mysqli("localhost", "root", "", "schoolies");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}

				$result = $conn->query('SELECT * FROM location;');
				if($result->num_rows > 0) {
					echo("<script>locations = [");
					while($row = $result->fetch_assoc()) {
						echo("['', " . $row["lat"] . ", " . $row["lon"] . ", " . $row["id"] . "],");
					}
					echo("];</script>");
				}
			?>
			<script type="text/javascript">
				/*var locations = [
					['Bondi Beach', -33.890542, 151.274856, 4],
					['Coogee Beach', -33.923036, 151.259052, 5],
					['Cronulla Beach', -34.028249, 151.157507, 3],
					['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
					['Maroubra Beach', -33.950198, 151.259302, 1]
				];*/

				var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 10,
				center: new google.maps.LatLng(-33.92, 151.25),
				mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				
				var infowindow = new google.maps.InfoWindow();
				var marker, i;
				
				for (i = 0; i < locations.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					//animation:google.maps.Animation.BOUNCE,
					map: map
				});
				
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
					}
				})(marker, i));
				}
			</script>
		</div>
	</body>
</html>