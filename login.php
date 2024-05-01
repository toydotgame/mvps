<!DOCTYPE html>
<!--
	AUTHOR: toydotgame
	CREATED ON: 2024-05-01
	I honestly have no idea what kind of website I'm making.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/styles.css">
		<title>Log In - Unnamed Schoolies Website</title>
		<meta name="viewport" content="width=device-width">
		<script src="/contentloader.js" type="module"></script>
		<script>
			function enableSubmit() {
				var fields = document.getElementsByClassName("field");
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
		<div id="nav"></div>
		<div id="content">
			<h1 style="text-align:center">Log In</h1>
			<form action="login" method="post"><table>
				<tr><td>Username:</td><td><input class="field" type="text" name="username" onkeyup="enableSubmit()" autofocus /></td></tr>
				<tr><td>Password:</td><td><input class="field" type="password" name="password" onkeyup="enableSubmit()" autofocus /></td></tr>
				<tr><td colspan="2"><input class="loginbtn" type="submit" value="Login" disabled /></td></tr>
			</table></form>
		</div>
	</body>
</html>