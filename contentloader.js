/*
 * AUTHOR: toydotgame
 * CREATED ON: 2024-02-16
 * Content-loading script so that I can update nav, header and footer,
 * etc all here and have it dynamically update across all pages.
 */

import {} from "/imgmodal.js";

document.getElementById("nav").innerHTML = `
<a href="/"><div>LOGO</div></a>
<a href=""><div>Plan</div></a>
`;

var recentblogs = `
<div id="recentblogs">
<h1>Recent Blog Posts</h1>
<ul>
	<li><a href="/blog/2024-01-03_fs-measurements"><b>2024-01-03:</b> Digital Metric Unit Nomenclature for Dummies</a></li>
	<li><a href="/blog/2024-01-01_web-design"><b>2024-01-01:</b> What's the deal with Modern Web Design?</a></li>
	<li><a href="/blog/2024-01-01_spigot-dating-sucks"><b>2024-01-01:</b> Minecraft Server Crashing? Try This. – or (Another Reason) why Spigot Sucks</a></li>
	<li><a href="/blog/2023-12-16_v5"><b>2023-12-16:</b> Site v5</a></li>
	<li><a href="/blog/2023-04-10_toypack"><b>2023-04-10:</b> ToyPack v1.13.6</a></li>
</ul>
</div>
`;

var badges = `
<img src="/media/badges/toydotgame.gif" width="88">
<img src="/media/badges/win7.gif" width="88">
<img src="/media/badges/invalidator.gif" width="88">
<img src="/media/badges/vcss-blue.gif" width="88">
<a href="http://www.wtfpl.net/"><img src="/media/badges/wtfpl.gif" width="88"></a>
<a href="https://thardwardy.github.io/"><img src="/media/badges/thardwardy.gif" width="88"></a>
<img src="/media/badges/2019.gif" width="88">
<a href="https://cyber.dabamos.de/88x31/"><img src="/media/badges/88x31.gif" width="88"></a>
<img src="/media/badges/abrowser.gif" width="88">
<img src="/media/badges/anythingbut.gif" width="88">
<a href="https://archlinux.org/"><img src="/media/badges/archlinux.gif" width="88"></a>
<img src="/media/badges/cssdif.gif" width="88">
<a href="https://www.dell.com/"><img src="/media/badges/dell.gif" width="88"></a>
<a href="https://www.mozilla.org/en-US/firefox/new/"><img src="/media/badges/firefox3.gif" width="88"></a>
<img src="/media/badges/gregg.gif" width="88">
<a href="https://archive.org/donate"><img src="/media/badges/internetarchive.gif" width="88"></a>
<img src="/media/badges/miku.gif" width="88">
<a href="https://minecraft.net/"><img src="/media/badges/minecraft.gif" width="88"></a>
<img src="/media/badges/minibanner.gif" width="88">
<img src="/media/badges/right2repair.gif" width="88">
<a href="https://yesterweb.org/no-to-web3/"><img src="/media/badges/roly-saynotoweb3.gif" width="88"></a>
<img src="/media/badges/transnow2.gif" width="88">
<a href="https://donate.wikimedia.org/><img src="/media/badges/wikipedia.gif" width="88"></a>
`;
export { badges };

var footer = `
<br>
<a href="https://www.free-website-hit-counter.com/"><img src="https://www.free-website-hit-counter.com/c.php?d=6&id=160327&s=5" width="88"></a>
<p>Website <copyleft></copyleft> 2024 toydotgame</p>
`;

/*
 * Footer replacement shouldn't run on Japanese-language pages. `/jp/contento.js` handles that.
 * However, this script is called and run by `contento.js`'s import statement.
 */
if(!window.location.pathname.startsWith("/jp/")) {
	try {
		document.getElementById("footer").innerHTML = "<hr>" + recentblogs + badges + footer;
	} catch {
		document.getElementById("blogfooter").innerHTML = "<hr>" + badges + footer;
		document.getElementById("blogfooter").id = "footer";
	}
}
