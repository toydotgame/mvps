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
		<title>Log In - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
		<script>
			function enableSubmit() {
				var fields = document.getElementsByClassName("field");
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
		<div id="nav"></div>
		<div id="content">
			<?php
				/* LOGIC FLOW:
				 * POST login type
				 *     Create new user page
				 *     [DONE] Login failed, user/pass incorrect
				 *     [DONE] Success (redir to user.php with the user id logged in)
				 *     Create new user success/fail
				 */

				$requestType = "login";
				//if(isset($_POST["requestType"])) $requestType = $_POST["requestType"];
				if(isset($_GET["email"]) || isset($_GET["username"]) && isset($_GET["password"])) $requestType = "createValidate";
				if(isset($_POST["username"]) && isset($_POST["password"])) $requestType = "loginValidate";
				if(isset($_GET["create"])) $requestType = "create";
				echo("Request Type: " . $requestType . "<br>");

				$conn = new mysqli("localhost", "root", "", "schoolies");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}

				switch($requestType) {
					case "login":
						echo('
							<h1 style="text-align:center">Log In</h1>
							<form action="login" method="post"><table>
								<tr><td>Username:</td><td><input class="field" type="text" name="username" onkeyup="enableSubmit()" autofocus /></td></tr>
								<tr><td>Password:</td><td><input class="field" type="password" name="password" onkeyup="enableSubmit()" /></td></tr>
								<tr><td colspan="2"><input class="loginbtn" type="submit" value="Login" disabled /></td></tr>
							</table></form>
							<p style="text-align:center">Not a user? <a href="/login?create=true">Create an account</a> now!</p>
						');
						break;
					case "loginValidate":
						$result = $conn->query('SELECT * FROM users WHERE username = "' . $_POST["username"] . '" AND password = "' . $_POST["password"] . '"');
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo('<script>window.location.replace("/user?id=' . $row["id"] . '");</script>');
							}
						} else {
							echo ('
								<h1 style="text-align:center">Incorrect username or password!</h1>
								<p>Please try to <a href="/login">log in</a> again.</p>
							');
						}
						break;
					case "create":
						echo('
							<h1 style="text-align:center">Create Account</h1>
							<form action="login" method="get"><table>
								<tr><td>E-Mail:</td><td><input type="text" name="email" autofocus /></td></tr>
								<tr><td>Username:</td><td><input class="field" type="text" name="username" onkeyup="enableSubmit()" /></td></tr>
								<tr><td>Password:</td><td><input class="field" type="password" name="password" onkeyup="enableSubmit()" /></td></tr>
								<tr><td colspan="2"><input class="loginbtn" type="submit" value="Create" disabled /></td></tr>
							</table></form>
						');
						break;
					case "createValidate";
						if(isset($_GET["email"])) {
							$result = $conn->query('INSERT INTO users (email, username, password) VALUES ("' . $_GET["email"] . '", "' . $_GET["username"] . '", "' . $_GET["password"] . '");');
						} else {
							$result = $conn->query('INSERT INTO users (username, password) VALUES ("' . $_GET["username"] . '", "' . $_GET["password"] . '");');
						}
						echo('<h1 style="text-align:center">User account created successfully!</h1>'); // Yeah that's it, no checks nor nothin
						echo('<p style="text-align:center">Please <a href="/login">now login</a>.</p>');
						break;
				}
			?>
		</div>
	</body>
</html>