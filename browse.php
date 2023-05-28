<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-05-28
    Main store page.
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
        <title>Store – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Store">
    </head>
    <body>
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<div id="storelanding">
				<h1>Store</h1>
				<h2>View all of a126's currently available<br>high-quality products!</h2>
			</div>
			<div id="storecontent">
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
					$result = $conn->query("SELECT * FROM inventory;");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) { // for() iterate over each row of table.
						echo '<div class="storeproduct" onclick="location.href=\'/product.php?id=' . $row["id"] . '\';" style="cursor: pointer;">'
							   . '<img src="' . $row["image"] .'" class="storethumb" />'
							   . '<h3 class="storeproductname">' . $row["name"] . '</h3>'
							   . '<p class="storepricetag">$' . $row["price"] . '</p>'
						   . '</div>';
						}
					} else {
						echo '<script>console.log("[ERROR] Failed to retrieve products from database! Empty set.");</script>';
					}
				?>
			</div>
        </main>
        <footer>&copy; 2023 a126</footer>
    </body>
</html>