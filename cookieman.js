/*
 * CREATED ON: 2024-07-25
 * AUTHOR: toydotgame
 * idk dude
 */

export function GetCookie(name) { // Stolen tehe
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}

var currentUser;
if(GetCookie("currentUser") != null && GetCookie("currentUser") != "") { // Retrieve logged in user if exists.
	currentUser = GetCookie("currentUser");
}

export function LogInUser(id) {
	console.log("setting user " + id);
	document.cookie = "currentUser=" + id;
}

export function LogOutUser() {
	console.log("login out");
	document.cookie = "currentUser="; // Will that do it? // It does.
}
