/*
 * AUTHOR: toydotgame
 * CREATED ON: 2024-02-29
 * ICCMC content loader minus the `aside` element.
 */

import {} from "/imgmodal.js";

document.getElementById("nav").innerHTML = `
<a href="/"><img id="logo" src="/media/logo.png"></a>
|
<a href="http://iccmc.toydotgame.net:8123/">Map</a>
|
<a href="/rules">Rules</a>
|
<a href="/about">About</a>
`;
