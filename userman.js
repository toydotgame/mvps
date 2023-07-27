/* 
 * CREATED ON: 2023-07-19
 * AUTHOR: toydotgame
 * User cookie and info management.
 */

import { GetCookie } from "/global.js";

var currentUser;
if(GetCookie("currentUser") != null && GetCookie("currentUser") != "") { // Retrieve logged in user if exists.
	currentUser = GetCookie("currentUser");
}

export function CreateUser() {

}

export function LogInUser(email, token) {
	console.log("setting user " + email + " with token " + token);
	document.cookie = "currentUser=" + email + ":" + token;
}

export function LogOutUser() {
	console.log("login out");
	document.cookie = "currentUser="; // Will that do it? // It does.
}
