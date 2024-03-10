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
		<!--<link rel="stylesheet" href="/form.css">-->
		<script>
			function enableSubmit() {
				var fields = document.getElementsByClassName("required");
				var btn = document.querySelector('input[type="submit"]');
				var valid = true;
				for(var i = 0; i < fields.length; i++) {
					if(fields[i].value.trim() === "" || fields[i].value.trim() === null) {
						valid = false;
						break;
					}
				}
				btn.disabled = !valid;
			}
		</script>
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
						$cost = "Free";
						if($row["cost"] != null && $row["cost"] > 0) {
							$cost = "$" . strval($row["cost"]);
						}
						echo('
							<img src="' . $row["img"] . '">
							<div id="textcontainer">
							<h1>' . $row["title"] . '</h1>
							<script>document.getElementsByTagName("title")[0].innerHTML = "' . $row["title"] . '";</script>
							<p><b>When:</b> ' . $row["time"] . '</p>
							<p><b>Where:</b> ' . $row["loc"] . '</p>
							<p><b>Contact E-Mail:</b> <a href="mailto:' . $row["email"] . '">' . $row["email"] . '</a></p>
							<p><b>Contact Phone:</b> ' . $row["phone"] . '</p>
							<p><b>Link:</b> <a href="' . $row["link"] . '" style="color:#00f">' . $row["title"] . '</a></p>
							<p><b>Cost:</b> ' . $cost . '</p>
							<br>
							<p>' . $row["long_desc"] . '</p><br>
							<!--<a href="form?id=' . $_GET["id"] . '"><div id="interestbutton">Interested?<br>Click Here</div></a>-->
							</div><br><br><br><br><br> <!-- very good way to make table display good-er -->
							
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
				<tr><td>Wave Height</td><td>1.1 m</td></tr>
			</table>
			<br><hr>
			<style>
				td:has(input[type="submit"]) {
					text-align: center;
				}

				table {
					margin-left: auto;
					margin-right: auto;
					margin-top: 24px;
				}

				.field {
					background-color: #eee;
					border: none;
						border-bottom: 2px solid #00a5a5;
					color: #444;
					width: 100%;
					height: 15%;
					margin: 15px 0;
					padding: 10px 25px;
					font-family: "Raleway", sans-serif;
					font-weight: 500;
					font-size: 14pt;
				}

				.field:focus {
					outline: none;
				}

				.loginbtn {
					width: 100%;
					padding: 8px;
					font-family: "Raleway", sans-serif;
					font-weight: 700;
					font-size: 14pt;
					margin-top: 25px;
					border: 1px solid #ccc;
					color: #fff;
					text-shadow: 1px 1px 2px #575760;
					border-radius: 7px;
					background-image: linear-gradient(#a6a6dd, #8181cf);
				}

				.loginbtn:hover {
					color: #eee;
					background-image: linear-gradient(#b9b9e4, #9494d6);
					text-decoration: underline;
					cursor: pointer;
				}

				.loginbtn:disabled {
					background-image: linear-gradient(#999, #777);
					color: #999;
					cursor:not-allowed;
				}

				.loginbtn:hover:disabled {
					color: #999;
					background-image: linear-gradient(#999, #777);
					text-decoration: none;
					cursor: not-allowed;
				}
			</style>
			<form action="submit" method="post"><table> <!-- tables are the superior form-making aid -->
				<?php
					if(is_null($_GET["id"])) {
						die("<h1>404</h1><p>The event you are looking for could not be found!</p>");
					}

					$conn = new mysqli("localhost", "root", "", "gccc");
					if($conn->connect_error) { // catch
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}
					
					// Get all info for certain event based off of `id` query string
					$result = $conn->query("SELECT * FROM events WHERE id = " . $_GET["id"] . ";");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) { // Should only run for 1 row but oh well
							echo('<tr><th colspan="2">Expression of Interest – ' . $row["title"] . '</th></tr>
							<tr style="display:none"><td>id</td><td><input type="text" name="id" value="' . $_GET["id"] . '" /><br></td></tr>
							'); // Hacky fix to convert the query string into a POST request value.
						}
					} else {
						echo '<script>console.log("[ERROR] Failed to retrieve current events from database! empty set.");</script>';
					}
				?>
				<tr><td>Name</td><td><input class="field required" type="text" name="name" placeholder="John Appleseed" onkeyup="enableSubmit()" autofocus /><br></td></tr>
				<tr><td>E-Mail Address</td><td><input class="field" type="text" name="email" placeholder="john@aol.com" onkeyup="enableSubmit()" /><br></td></tr>
				<tr><td>Mobile Number</td><td><input class="field required" type="text" name="phone" placeholder="0400 000 000" onkeyup="enableSubmit()" /><br></td></tr>
				<tr><td colspan="2"><input class="loginbtn" type="submit" value="Submit" disabled /></td></td>
			</table></form>
		</div></div>
		<div id="footer">
			<p>All rights are reserved by the respective copyright holders of the text and images on this page. Click <a href="https://www.goldcoast.qld.gov.au/disclaimer-and-copyright.html" style="color:#33e">here</a> to see the disclaimer.</p>
			<p>&copy; 2024 Gold Coast City Council</p>
		</div>
	</body>
</html>
