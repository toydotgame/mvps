<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-05-28
	Cart page that pulls product info from the DB
	and cart info from local cookies.
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
        <title>Cart – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Cart">
		<script src="globalcartman.js" type="module"></script>
    </head>
    <body>
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<ul>
			<?php
			// DB Connection
			$servername = "localhost";
			$username = "root";
			$password = "";
			$db = "web_shop";
			$conn = new mysqli($servername, $username, $password, $db);
			if($conn->connect_error) { // catch
				die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
			}

			// Retrieve cart cookie
			if(!isset($_COOKIE["cart"])) {
				echo '<h1 align="center" style="font-size:50px;"><br><br>Cart is empty.</h1><h2 align="center">Head to the <a href="/browse.php" style="text-decoration:none; font-weight:bold; color:#34cc33;">store</a> to see<br>our latest products!</h2>';
				exit;
			}
			$cart = json_decode($_COOKIE["cart"]);

			for($i = 0; $i < count($cart); $i++) {
				// $cart[$i][0] = ID
				// $cart[$i][1] = Count
				$result = $conn->query("SELECT * FROM inventory WHERE id = '" . $cart[$i][0] . "';");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { // for() iterate over each row of table.
					echo '<li>Product: ' . $row["name"] . ', Count: ' . $cart[$i][1] . '</li>';
					}
				} else {
					echo '<script>console.log("[ERROR] Failed to retrieve products from database! Empty set.");</script>';
				}
			}

			// Run query
			$result = $conn->query("SELECT * FROM inventory;"); // Get row of DB table where ID = id query string in URL
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { // for() iterate over each row of table.
				echo '';
				}
			} else {
				echo '<script>console.log("[ERROR] Failed to retrieve products from database! Empty set.");</script>';
			}
			?>
			</ul>
        </main>
        <footer>&copy; 2023 a126</footer>
    </body>
</html>