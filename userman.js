/* 
 * CREATED ON: 2023-07-19
 * AUTHOR: toydotgame
 * User cookie and info management.
 */

import { GetCookie } from "/global.js";

var currentUser;
if(GetCookie("currentUser") != null) { // Retrieve logged in user if exists.
	currentUser = JSON.parse(GetCookie("currentUser"));
}

export function CreateUser() {

}

export function LogInUser(token) {
	alert("setting user " + token)
	document.cookie = "currentUser=" + JSON.stringify(token);
}

export function LogOutUser() {

}
