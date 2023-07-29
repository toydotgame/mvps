<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-07-29
	Signup page.
-->

<html>
    <head>
        <meta charset="UTF-8">
		<style>
			/* Reset browser styles */
			* {
				margin: 0;
				padding: 0;
			}
		</style>
        <link rel="stylesheet" href="styles.css" />
        <title>Sign Up – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Sign Up">
		<script>
			function enableSubmit() {
				var fields = document.getElementsByClassName("loginform");
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
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<?php
				if(empty($_POST)) {
					goto eof; // Show HTML form
				}

				$conn = new mysqli("localhost", "root", "", "web_shop");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}
				$result = $conn->query("
					INSERT INTO users (firstname, lastname, email, password, address, cc)
					VALUES (\"" . $_POST["firstname"] . "\", \"" . $_POST["lastname"] . "\", \"" . $_POST["email"] . "\", \"" . md5($_POST["password"]) . "\", \"" . $_POST["address"] . "\", \"" . $_POST["cc"] . "\");
				");
				if($result === TRUE) {
					die('<script>alert("Signup successful. You can now log in with your new account!"); window.location.replace("/index.html");</script>');
				} else {
					die('<script>console.log("There was an error creating acct");<script>');
				}
				// TODO: If POST content is sent, INSERT INTO users the new user and if else, show the login form.
				eof:
			?>
			<div align="center"><form action="#" method="post">
				<h1 align="center" style="font-size:50px; margin:50px 0;">Sign Up</h1>
				<input class="loginform" type="text" name="email" placeholder="E-Mail" onkeyup="enableSubmit()" autofocus /><br>
				<input class="loginform" type="password" name="password" placeholder="Password" onkeyup="enableSubmit()" /><br>
				<input class="loginform" type="text" name="firstname" placeholder="First Name" onkeyup="enableSubmit()" /><br>
				<input class="loginform" type="text" name="lastname" placeholder="Last Name" onkeyup="enableSubmit()" /><br>
				<input class="loginform" type="text" name="address" placeholder="Postal Address" onkeyup="enableSubmit()" /><br>
				<input class="loginform" type="text" name="cc" placeholder="Credit Card Number" onkeyup="enableSubmit()" /><br>
				<input class="loginbtn" type="submit" disabled />
				</form></div>
        </main>
        <footer style="line-height:8px">&copy; 2023 a126<br><small style="font-size:6px;">By using a126, you consent to the use of cookies being used for site functionality.</small></footer>
    </body>
</html>