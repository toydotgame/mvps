<!DOCTYPE html>

<!--
    AUTHOR: toydotgame
    CREATED ON: 2023-07-29
	Checkout page for lazy chuck cart cookie into db.
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
        <title>Checkout Success – a126</title>
        <meta property="og:type" content="website">
		<meta property="og:site_name" content="a126">
		<meta property="og:title" content="Checkout">
		<script src="cartman.js" type="module"></script>
		<script src="userman.js" type="module"></script>
    </head>
    <body>
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<div id="cartcontent">
				<?php
					// here we go again...

					if(!isset($_COOKIE["cart"]) || $_COOKIE["cart"] == "[]") {
						die("nothing in cart lol go away");
					}
					$cart = json_decode($_COOKIE["cart"]);

					$conn = new mysqli("localhost", "root", "", "web_shop");
					if($conn->connect_error) {
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}

					$resultorderid = $conn->query("SELECT MAX(orderid) FROM pending;");
					while($roworderid = $resultorderid->fetch_assoc()) {
						$orderid = $roworderid["MAX(orderid)"] + 1;
					}

					$resultuserid = $conn->query("SELECT * FROM users WHERE email = \"" . strtok($_COOKIE["currentUser"], ":") . "\";");
					while($rowuserid = $resultuserid->fetch_assoc()) {
						$userid = $rowuserid["id"];
					}

					for($i = 0; $i < count($cart); $i++) {
						echo "
						INSERT INTO pending (orderid, productid, quantity, userid)
						VALUES (" . $orderid . ", " . $cart[$i][0] . ", " . $cart[$i][1] . ", " . $userid . ");
						";
						$resultplaceorder = $conn->query("
							INSERT INTO pending (orderid, productid, quantity, userid)
							VALUES (" . $orderid . ", " . $cart[$i][0] . ", " . $cart[$i][1] . ", " . $userid . ");
						");
						if ($resultplaceorder === TRUE) {
							// not bothered to rewrite if to make this look nice
						} else {
							die('there was an issue checking out, please try again later');
						}
					}
				?>
				<style>#cartcontent { width:100vw !important; float:none !important; padding: 0; }</style>
				<h1 align="center" style="font-size:50px; width:100% !important; float:none !important;">
					<br><br><br>
					Checkout was successful!
				</h1>
				<h2 align="center">
					Thank you for shopping with us!<br>
					Expect to see an e-mail soon confirming your order is on its way!
				</h2>
			</div>
			
        </main>
        <footer style="line-height:8px">&copy; 2023 a126<br><small style="font-size:6px;">By using a126, you consent to the use of cookies being used for site functionality.</small></footer>
    </body>
</html>