/* 
 * CREATED ON: 2023-07-19
 * AUTHOR: toydotgame
 * Global functions for the JS frontend.
 */

export function GetCookie(name) { // Stolen tehe
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}
