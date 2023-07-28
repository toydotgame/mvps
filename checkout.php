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