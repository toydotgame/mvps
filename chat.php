<!DOCTYPE html>
<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-05-01
	I honestly have no idea what kind of website I'm making.
-->

<?php
	// Code to run if this page is being loaded because the user sent a message:
	if(!isset($_POST["upload"])) {
		goto eob; // Skip to the end of execution and do nothing if it's just a normal page load
	}
	
	$target = "images/" . basename($_FILES["image"]["name"]); // Uploaded image will be stored in /images/
	$db = mysqli_connect("localhost", "root", "", "schoolies"); // Establish DB conn.
	$image = $_FILES["image"]["name"];
	$message = $_POST["message"];
	$user = $_COOKIE["currentUser"]; // Get logged on user from cookies

	if(str_starts_with($message, "!locationshare")) { // Sharing location
		$args = explode(" ", $message);
		echo floatval($args[1]);
		$sql = "INSERT INTO location (lat, lon) VALUES ('" . floatval($args[1]) . "', '" . floatval($args[2]) . "');";
		echo $sql;
		mysqli_query($db, $sql);
		$sql = "INSERT INTO chat (message, user) VALUES ('User " . $user . " has shared a new location: <a href=\"/map\">" . $args[1] . "," . $args[2] . "</a>.', 1);";
		mysqli_query($db, $sql);
	} else { // Regular messaging
		$sql = "INSERT INTO chat (message, image, user) VALUES ('" . $message . "', '" . $image . "', " . $user . ");";
		mysqli_query($db, $sql); // Upload image, attached message, and message author

		if(move_uploaded_file($_FILES["image"]["tmp_name"], $target)) { // Upload image from web request to local server folder
			echo '<script>console.log("img upload success");</script>';
		} else {
			echo '<script>console.log("img upload err!");</script>';
		}
	}

	eob:
?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/styles.css">
		<title>Chat - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
	</head>
	<body>
		<div id="nav"></div>
		<div id="content">
			<?php
				// Deny access to non-logged in users:
				if(!isset($_COOKIE["currentUser"]) || $_COOKIE["currentUser"] == null || $_COOKIE["currentUser"] == "") {
					die('<h1 style="text-align:center">You cannot access this chat without <a href="/login">logging in</a> first!</h1>');
				}
			?>
			<div id="chatcontainer">
				<div id="chatmessages">
					<?php
						// Code to run always to load chat messages:
						$db = mysqli_connect("localhost", "root", "", "schoolies"); // Establish DB conn.
						$sql = "SELECT * FROM chat;";
						$result = mysqli_query($db, $sql);

						while($row = mysqli_fetch_array($result)) {
							$sql = "SELECT username FROM users WHERE id = " . $row["user"] . " LIMIT 1;";
							$user = "";
							$resultd = mysqli_query($db, $sql);
							while($j = mysqli_fetch_array($resultd)) {
								$user = $j["username"];
							}
							if($row["user"] == 1) { // Admin user has special message formatting to emulate system alerts
								echo('
								<div class="chatmessage">
									<p><b title="' . $row["time"] . '">' . $row["message"] . '</b></p></div>');
							} else { // Regular user message:
								echo('
									<div class="chatmessage">
										<p><b title="' . $row["time"] . '">' . $user . ':</b> ' . $row["message"] . '</p>
								');
								if($row["image"] != null || $row["image"] != "") {
									echo('<img class="chatimage" src="images/' . $row["image"] . '">');
								}
								echo('</div>');
							}
						}

						eob2:
					?>
				</div>
				<script>
					// Scroll to the bottom of the chat window when new messages are loaded:
					var chatWindow = document.querySelector("#chatmessages");
					chatWindow.scrollTop = chatWindow.scrollHeight;

					function isEnterPressed(e) {
						var code = (e.keyCode ? e.keyCode : e.which);
						if(code == 13) { //Enter keycode
							document.msgboxform.submit();
						}
					}
				</script>
				<form name="msgboxform" method="post" action="chat.php" enctype="multipart/form-data">
					<input type="hidden" name="size" value="10000000">
					<label for="chatfile" id="chatupload">📷</label>
						<input type="file" id="chatfile" name="image">
					<input type="text" name="message" id="chatinput" placeholder="Message #chat..." onkeyup="isEnterPressed(event)" autofocus></input>
					<input type="submit" name="upload" id="chatsend" value="➤">
				</form>
			</div>
		</div>
	</body>
</html>