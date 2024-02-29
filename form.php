<!DOCTYPE html>

<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-03-01
	Form page.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/form.css">
		<title>Expression of Interest - Gold Coast City Council</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
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
			<form action="submit" method="post"><table> <!-- tables are the superior form-making aid -->
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
							echo('<tr><th colspan="2">Expression of Interest – ' . $row["title"] . '</th></tr>
							<tr style="display:none"><td>id</td><td><input type="text" name="id" value="' . $_GET["id"] . '" /><br></td></tr>
							');
						}
					} else {
						echo '<script>console.log("[ERROR] Failed to retrieve current events from database! empty set.");</script>';
					}
				?>
				<tr><td>Name</td><td><input class="field required" type="text" name="name" placeholder="John Appleseed" onkeyup="enableSubmit()" autofocus /><br></td></tr>
				<tr><td>E-Mail Address</td><td><input class="field" type="text" name="email" placeholder="john@aol.com" onkeyup="enableSubmit()" /><br></td></tr>
				<tr><td>Mobile Number</td><td><input class="field required" type="text" name="phone" placeholder="0400 000 000" onkeyup="enableSubmit()" /><br></td></tr>
				<tr><td colspan="2"><input class="loginbtn" type="submit" disabled /></td></td>
			</table></form>
			
		</div></div>
		<div id="footer"><p>&copy; 2024 Gold Coast City Council</p></div>
	</body>
</html>
