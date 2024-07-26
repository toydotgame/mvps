/*
 * AUTHOR: toydotgame
 * CREATED ON: 2024-04-23
 * ICCMC content loader minus the `aside` element.
 */

document.getElementById("nav").innerHTML = `
<a href="/" class="navitem">Home</a>
<a href="/chat" class="navitem">Chat</a>
<a href="/map" class="navitem">Map</a>
<a href="/emergency" style="color:#e11; font-weight:bold" class="navitem">Emergency</a>

<a href="/login" class="navitemr">Log In</a>
`;
