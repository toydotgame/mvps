<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-07-29
	Employee only page with pending order db
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
        <title>Pending Orders – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Pending Orders">
		<script src="cartman.js" type="module"></script>
		<script src="userman.js" type="module"></script>
    </head>
    <body>
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<div style="margin:5%">
				<h1>Pending Orders</h1>
				<?php
					$conn = new mysqli("localhost", "root", "", "web_shop");
					if($conn->connect_error) {
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}
					echo '<table>
					<tr><th>Order ID</th><th>Product</th><th>Quantity</th><th>Fulfilled</th><th>Shipping Address</th></tr>';
					$result = $conn->query("
						SELECT * FROM pending WHERE fulfilled != TRUE OR fulfilled IS NULL;
					");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row["fulfilled"] == 1) {
								$checkbox = "<input type=\"checkbox\" checked>";
							} else {
								$checkbox = "<input type=\"checkbox\">";
							}
							// im literally jsut not finishing the employee page omg

							$orderaddr = $conn->query("SELECT address FROM users WHERE id = " . $row["userid"])->fetch_assoc()["address"];
							$productname = $conn->query("SELECT name FROM inventory WHERE id = " . $row["productid"])->fetch_assoc()["name"];

							echo '<tr><td>' . $row["orderid"] . '</td><td>' . $productname . '</td><td>' . $row["quantity"] . '</td><td>' . $checkbox . '</td><td>' . $orderaddr . '</td></tr>';
						}
						echo '</table>';
					} else {
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}
				?>
				<hr>
				<h1>Fulfilled Orders</h1>
				<?php
					$conn = new mysqli("localhost", "root", "", "web_shop");
					if($conn->connect_error) {
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}
					echo '<table>
					<tr><th>Order ID</th><th>Product</th><th>Quantity</th><th>Fulfilled</th><th>Shipped To</th></tr>';
					$result = $conn->query("
						SELECT * FROM pending WHERE fulfilled = TRUE;
					");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row["fulfilled"] == 1) {
								$checkbox = "<input type=\"checkbox\" checked>";
							} else {
								$checkbox = "<input type=\"checkbox\">";
							}

							$orderaddr = $conn->query("SELECT address FROM users WHERE id = " . $row["userid"])->fetch_assoc()["address"];
							$productname = $conn->query("SELECT name FROM inventory WHERE id = " . $row["productid"])->fetch_assoc()["name"];

							echo '<tr><td>' . $row["orderid"] . '</td><td>' . $productname . '</td><td>' . $row["quantity"] . '</td><td>' . $checkbox . '</td><td>' . $orderaddr . '</td></tr>';
						}
						echo '</table>';
					} else {
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}
				?>
			</div>
        </main>
        <footer style="line-height:8px">&copy; 2023 a126<br><small style="font-size:6px;">By using a126, you consent to the use of cookies being used for site functionality.</small></footer>
    </body>
</html>