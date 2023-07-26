<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-04-20
    Main landing page for the shop website.
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
        <title>Login – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Login">
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
				if(!isset($_POST["password"])) { // i frogor how post req works in php so erm lol
					die('<div align="center"><form action="#" method="post">
							 <h1 align="center" style="font-size:50px; margin:50px 0;">Log In</h1>
							 <input class="loginform" type="text" name="email" placeholder="E-Mail" onkeyup="enableSubmit()" autofocus /><br>
							 <input class="loginform" type="password" name="password" placeholder="Password" onkeyup="enableSubmit()" /><br>
							 <input class="loginbtn" type="submit" disabled />
						 </form></div>');
				}

				$conn = new mysqli("localhost", "root", "", "web_shop");
				if($conn->connect_error) {
					die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
				}
				$result = $conn->query("SELECT * FROM users WHERE (email, password) = (\"" . $_POST["email"] . "\", \"" . md5($_POST["password"]) . "\");");
				if ($result->num_rows > 0) {
					while($usr = $result->fetch_assoc()) {
						// Set the damn cookie
						echo '<script type="module">
								  import { LogInUser } from "./userman.js";
								  LogInUser("' . md5($_POST["password"]) . '");
							  </script>';
					}
				} else {
					die('<style>#cartcontent { width:100vw !important; float:none !important; padding: 0; }</style><h1 align="center" style="font-size:50px; width:100% !important; float:none !important;"><br><br><br>Login Failed!</h1><h2 align="center">Incorrect username or password.<br>Head to the <a href="/login.php" style="text-decoration:none; font-weight:bold; color:#34cc33;">log in</a> page to try again.</h2>');
				}
			?>
			
        </main>
        <footer style="line-height:8px">&copy; 2023 a126<br><small style="font-size:6px;">By using a126, you consent to the use of cookies being used for site functionality.</small></footer>
    </body>
</html>