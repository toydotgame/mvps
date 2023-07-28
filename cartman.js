/*
 * CREATED ON: 2023-05-28
 * AUTHOR: toydotgame, kirlich (from SO)
 * Site-wide cookie-based cart system. Defines some
 * basic functions to manipulate a 2D array containing
 * a row for a product ID and unit count desired for
 * purchase.
 */

import { GetCookie } from "/global.js";

var cart = [];
if(GetCookie("cart") != null) { // Retrieve cart info from cookie if cookie exists.
	cart = JSON.parse(GetCookie("cart"));
}

export function IndexOf2D(array, value) {
	var index = -1;
	for(var i = 0; i < array.length; i++){
		if(array[i][0] == value){
			index = i;
		}
	}
	return index;
}

export function AddToCart(count) {
	var id = parseInt(new URLSearchParams(window.location.search).get('id'));
	var cartindex = IndexOf2D(cart, id);
	if(cartindex == -1) {
		cart.push([id, count]);
	} else {
		cart[cartindex][1] += count;
	}
	document.cookie = "cart=" + JSON.stringify(cart);

	window.location.href = "cart.php";
}

export function OverwriteCart(id, count) { // Assumes cart object already exists, as it cannot create a new cart entry.
	/*console.log("OverwriteCart() run:\n"
		+ "id: " + id + "\n"
		+ "count: " + count + "\n"
		+ "cartindex: " + IndexOf2D(cart, id) + "\n"
		+ "cart: " + JSON.stringify(cart) 
	);*/
	var cartindex = IndexOf2D(cart, id);
	if(cartindex == -1) { // Not in cart? Break.
		return;
	}
	if(count == 0) { // In cart but new count is 0? Remove it from the cart.
		cart.splice(cartindex, 1);
		document.cookie = "cart=" + JSON.stringify(cart);
		return;
	}
	cart[cartindex][1] = parseInt(count); // In cart and count is non-zero? Overwrite count.
	document.cookie = "cart=" + JSON.stringify(cart);
}

export function ClearCart() { // dont use pls
	console.log("clearing cart!!!");
	document.cookie = "cart="; // nuclear
}
