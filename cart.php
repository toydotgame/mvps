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
			<div id="cartcontent">
				<script type="module">
					import { OverwriteCart } from "./globalcartman.js";
					for(var i = 0; i < document.getElementsByClassName("cartqty").length; i++) {
						document.getElementsByClassName("cartqty")[i].addEventListener("blur", OnBlur);
					}
					function OnBlur(e) {
						OverwriteCart(e.target.id, e.target.value);
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

					// Retrieve cart cookie
					if(!isset($_COOKIE["cart"])) {
						die('<h1 align="center" style="font-size:50px;"><br><br>Cart is empty.</h1><h2 align="center">Head to the <a href="/browse.php" style="text-decoration:none; font-weight:bold; color:#34cc33;">store</a> to see<br>our latest products!</h2>');
					}
					$cart = json_decode($_COOKIE["cart"]);

					for($i = 0; $i < count($cart); $i++) {
						// $cart[$i][0] = ID
						// $cart[$i][1] = Count
						$result = $conn->query("SELECT * FROM inventory WHERE id = '" . $cart[$i][0] . "';");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) { // for() iterate over each row of table.
								echo '<div class="cartitem">'
									   . '<img src="' . $row["image"] . '" />'
									   . '<input class="cartqty" placeholder="Qty." value="' . $cart[$i][1] . '" type="number" onKeyPress="if(this.value.length==3) return false;" min="0" max="999" id="' . $cart[$i][0] . '"></input>' // Element ID set to product ID for simplicity of pulling ID value from JS.
									   . '<h1><a href="product.php?id=' . $row["id"] . '">' . $row["name"] . '</a></h1><br>'
									   . '<p>$' . number_format($row["price"] * $cart[$i][1], 2) . ' ($' . number_format($row["price"], 2) . ' ea.)</p>'
								   . '</div>';
							}
						} else {
							die('<script>console.log("[ERROR] Failed to retrieve products from database! Empty set.");</script>');
						}
					}
					echo '<hr style="width:100%; border-radius:0; margin:0; border:2px solid #555; border-style:solid none none none;">';
				?>
			</div>
			<code>// TODO: customisible OverrideCart() qty boxes, remove button, names, etc
				<br>also gotta do right pane with order total, logged in user and shipping address (greyed out form for logged in user rn), and checkout button
			</code>
        </main>
        <footer style="line-height:8px">&copy; 2023 a126<br><small style="font-size:6px;">By using a126, you consent to the use of cookies being used for site functionality.</small></footer>
    </body>
</html>