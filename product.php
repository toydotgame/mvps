<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-05-28
	Generic template page that pulls info from the DB
	depending on the query flag (`?id=`) that this page
	is accessed from.
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
        <title>Product – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Product">
    </head>
    <body>
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<script type="module">
				import { AddToCart } from "./globalcartman.js";
				document.getElementById("cartbtn").addEventListener("click", OnClick);
				function OnClick() {
					AddToCart(1);
				}
			</script>
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

			// Run query
			$result = $conn->query("SELECT * FROM inventory WHERE id = '" . $_GET["id"] . "';"); // Get row of DB table where ID = id query string in URL
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { // for() iterate over each row of table.
				echo '<img src="' . $row["image"] . '" id="productimg" />'
				   . '<script>document.title = "' . $row["name"] . ' – a126";</script>'
				   . '<div id="productinfo">'
					   . '<h1 id="productname">' . $row["name"] . '</h1>'
					   . '<h2 id="productprice">$' . $row["price"] . '</h2>'
					   . '<hr>'
					   . '<p id="productdesc">' . $row["description"] . '</p>'
					   . '<button id="cartbtn">Add to Cart</button>'
				   . '</div>';
				}
			} else {
				echo '<h1 align="center" style="font-size:50px;"><br><br>Error 404</h1><h2 align="center">Product could not be found!</h2>';
			}
			?>
        </main>
        <footer>&copy; 2023 a126</footer>
    </body>
</html>