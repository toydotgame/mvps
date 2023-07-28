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
		<script src="cartman.js" type="module"></script>
		<script src="userman.js" type="module"></script>
    </head>
    <body>
        <header>
            <iframe src="navbar.html" scrolling="no" frameborder="0" width="100%" style="height: 64px"></iframe>
        </header>
        <main>
			<div id="cartcontent">
				<script type="module">
					import { OverwriteCart } from "./cartman.js";
					for(var i = 0; i < document.getElementsByClassName("cartqty").length; i++) {
						document.getElementsByClassName("cartqty")[i].addEventListener("blur", OnBlur);
					}
					function OnBlur(e) {
						OverwriteCart(e.target.id, e.target.value);
						window.location.reload(); // This sucks.
					}
					window.DeleteItemFromCart=(id) => { // icky globally attached thing
						if(confirm("Are you sure you would like to remove this item from your cart?") == true) {
							OverwriteCart(id, 0);
							window.location.reload();
						}
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
					if(!isset($_COOKIE["cart"]) || $_COOKIE["cart"] == "[]") {
						die('<style>#cartcontent { width:100vw !important; float:none !important; padding: 0; }</style><h1 align="center" style="font-size:50px; width:100% !important; float:none !important;"><br><br><br>Cart is empty.</h1><h2 align="center">Head to the <a href="/browse.php" style="text-decoration:none; font-weight:bold; color:#34cc33;">store</a> to see<br>our latest products!</h2>');
					}
					$cart = json_decode($_COOKIE["cart"]);

					echo '<h1>Cart</h1>'
					   . '<br>';
					for($i = 0; $i < count($cart); $i++) {
						// $cart[$i][0] = ID
						// $cart[$i][1] = Count
						$result = $conn->query("SELECT * FROM inventory WHERE id = '" . $cart[$i][0] . "';");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) { // for() iterate over each row of results.
								echo '<div class="cartitem">'
									   . '<img src="' . $row["image"] . '" />'
									   . '<img class="cartbin" src="/media/bin.svg" onclick="DeleteItemFromCart(' . $cart[$i][0] . ')" />'
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
			<div id="cartsidebar">
				<?php
					// DB Connection
					$servername = "localhost";
					$username = "root";
					$password = "";
					$db = "web_shop";
					$conn = new mysqli($servername, $username, $password, $db);
					if($conn->connect_error) {
						die('<script>console.log("[ERROR] DB connection failure! Trace: ' . $conn->connect_error . '");</script>');
					}

					// Retrieve cookie
					// Value is an MD5 pseudo-token, but in reality is a hash of the user's passwd "due to time constraints (totally)".
					if(!isset($_COOKIE["currentUser"])) {
						//die('<style>#cartcontent { width:100vw !important; float:none !important; padding: 0; }</style><h1 align="center" style="font-size:50px; width:100% !important; float:none !important;"><br><br>Cart is empty.</h1><h2 align="center">Head to the <a href="/browse.php" style="text-decoration:none; font-weight:bold; color:#34cc33;">store</a> to see<br>our latest products!</h2>');
						die('<h1>Checkout</h1><p>You are not logged in! Head to the <a href="/login.php">log in</a> page to sign in.</p>');
					}
					$loginToken = $_COOKIE["currentUser"];
					// Stealing Code
					// Stealing Code
					// Stealing Code, Code, Code
					// Writing what belongs to others puts me in a good mood
					// Though my friends say that I shouldn't
					// There is nothing that I wouldn't
					// Steal Code, Code, Code, Code, Code
					$delim = ":";
					$currentUser = "";
					$index = strrpos($loginToken, $delim);
					if ($index !== false) {
						$currentUser = substr($loginToken, $index + strlen($delim));
					}

					// Get sum of cart totals
					$total = number_format(0, 2);
					if(isset($_COOKIE["cart"]) && $_COOKIE["cart"] != "[]") {
						$cart = json_decode($_COOKIE["cart"]);
						$processingtotal = 0;
						for($i = 0; $i < count($cart); $i++) {
							$result = $conn->query("SELECT * FROM inventory WHERE id = '" . $cart[$i][0] . "';");
							if ($result->num_rows > 0) {
								while($sumrow = $result->fetch_assoc()) {
									$processingtotal += $sumrow["price"] * $cart[$i][1];
								}
							} else {
								die('<script>console.log("[ERROR] Failed to retrieve products from database! Empty set.");</script>');
							}
						}
						$total = number_format($processingtotal, 2);
					}

					// Render checkout
					echo '<h1>Checkout</h1>';
					echo '<b>Order Total:</b> $' . $total . '<hr style="width:100%; border-radius:0; margin:20px 0; border:2px solid #555; border-style:solid none none none;">';
					$result = $conn->query("SELECT * FROM users WHERE password = '" . $currentUser . "';");
					if ($result->num_rows == 1) {
						while($userObj = $result->fetch_assoc()) {
							echo '<b>Deliver To:</b><br>';
							echo $userObj["firstname"] . ' ' . $userObj["lastname"] . '<br>'
							   . $userObj["address"];
							echo '<hr style="width:100%; border-radius:0; margin:20px 0; border:2px solid #555; border-style:solid none none none;">';
							echo '<b>Order status will be sent to:</b> ' . $userObj["email"] . '<br>';
							echo '<b>Billing:</b> xxxx xxxx xxxx ' . substr($userObj["cc"], -4); // "security"
							echo '<hr style="width:100%; border-radius:0; margin:20px 0; border:2px solid #555; border-style:solid none none none;">';
							echo '<div style="margin:0 5px; width:auto; height:40px; border-radius:5px; background-color:#34cc33;"><a style="text-align:center; padding-top:5px; display:block; width:100%; height: 100%; text-decoration:none; color:#1c1c1c; font-size:18pt; font-weight:bold;" href="/checkout.php">Checkout</a></div>';
						}
					} else {
						die('<script>console.log("[ERROR] Failed to retrieve logged in user!");</script>');
					}
				?>
			</div>
        </main>
        <footer style="line-height:8px">&copy; 2023 a126<br><small style="font-size:6px;">By using a126, you consent to the use of cookies being used for site functionality.</small></footer>
    </body>
</html>