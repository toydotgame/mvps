/*
 * AUTHOR: toydotgame
 * CREATED ON: 2024-02-29
 * ICCMC content loader minus the `aside` element.
 */

document.getElementById("nav").innerHTML = `
<div style="float:left;margin-top:-6px;">
<a href="/"><img id="logo" src="/media/logo.png" style="margin-right:2em;"></a>
<a href="">Plan</a>
|
<a href="/">Places to Go</a>
|
<a href="/">Things To Do</a>
|
<a href="/">Events</a>
|
<a href="">Deals</a>
</div><div style="float:right;">
<a href="">Sign Up</a>
</div>
`;
