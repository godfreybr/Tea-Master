// JavaScript Document

// This connects to the HTML5 local storage and
// retrieves the shopping cart.
// HTML5 local storage only supports strings
// so we use JSON.parse() to convert the string
// into something useful.
function cart_CartToArray()
{
	var cart = localStorage.getItem("shopping_cart")
}

// This connects to the HTML5 local storage and
// updates the shopping cart.
// HTML5 local storage only supports strings
// so we use JSON.stringify() to convert the array
// into a string format.
function cart_ArrayToCart()
{
	localStorage.setItem("shopping_cart", "empty");
}