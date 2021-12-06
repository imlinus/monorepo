<!--
                                ~\\|//~
                                -(o o)-
               xxxxxxxxxxxxoOOOoxx(_)xxoOOOoxxxxxxxxxxxx
               |                                       |
               |       -------------------------       |
               |          Source Code Denied           |
               |               Sry m8...               |
               |       -------------------------       |
               |                                       |
               |             .oooO   Oooo.             |
               xxxxxxxxxxxxxx(   )xxx(   )xxxxxxxxxxxxxx
                              \ (     ) /
                               \_)   (_/

-->
































































 

<html><body leftmargin="0" topmargin="0"><head><title>SPLUTT</title>
<meta name="description" content="På denna sida hittar du t.ex online-spel och roliga bilder."> 
<meta name="keywords" content="splutt, onlinespel, bus, downloads, filmklipp, roliga bilder"> 
</head>
	<link rel="stylesheet" href="css.css" type="text/css">
<!-- Start WEBSTAT kod --> 
<span id="webstat"> 
<script src="http://www.webstat.se/inc/detectplugins_source.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript"> 
<!-- 
var info="&plugins=" + (detectFlash()?"flash|":"") + (detectDirector()?"shockwave|":"") + (detectQuickTime()?"quicktime|":"") + (detectReal()?"realplayer|":"") + (detectWindowsMedia()?"windowsmedia|":""); 
document.write("<" + "script src=\"http://www.webstat.se/count.asp?id=24737&size=" + screen.width + "x" + screen.height + "&depth=" + screen.colorDepth + "&referer=" + escape(document.referrer) + info + "\"></" + "script>"); 
--> 

</script> 
</span> 
<!-- Slut WEBSTAT kod --><table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" style="background-image: url(kludd.gif); background-repeat: no-repeat;">
	<tr><td align="center" valign="center">
<table width="800" cellpadding="0" cellspacing="10">
	<tr>
				<td width="800" colspan="2"  style="border: 1px #000000 dotted;" background="rutcolor.gif" align="right">
<div id="top">
<br><br><br><br><br><br>
</div>
		</td>
	</tr>

	<tr>


		<td width="200"  valign="top"  background="rutcolor.gif" style="border: 1px #000000 dotted;" height="300">
<div id="meny" >
<img src="top.gif" width="100%" height="33">
<B>
<ul>
<b>Underhållning</b><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=spel" style="text-decoration: none;">Online-spel</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=filmklipp" style="text-decoration: none;">Filmklipp</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=bilder" style="text-decoration: none;">Bilder</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=bus" style="text-decoration: none;">Bus</a><br>

</ul><ul>
<b>Övrigt</b><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=downloads" style="text-decoration: none;">Downloads</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=webradio" style="text-decoration: none;">Web-radio</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=lankar" style="text-decoration: none;">Länkar</a>
</ul>

<ul><b>Splutt</b><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=copyright" style="text-decoration: none;">Copyright</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=kontakt" style="text-decoration: none;">Kontakt</a><br>
&nbsp;&nbsp;&nbsp;» <a href="?visa=start" style="text-decoration: none;">Startsidan</a>

</ul>

</B>


<br><br><br><br><div align="center" ></b> </div>

</div>


		</td>






		<td width="590" rowspan="2" valign="top" style="border: 1px #000000 dotted;background-image: url(top2.gif); background-repeat: no-repeat;" bgcolor="#C2C287" >
<div id="mit">
<br><br><img src="spacer.gif" width="15" height="100%" align="left">



<?php





if (isset($_GET['visa'])) {

    if (file_exists($_GET['visa'].".php")) {

        include $_GET['visa'].".php";

    } else {

        echo "The file ".$_GET['visa'].".php does not exist";

    }

}
else {

    include "spelIE.php";

}



?>




</div>
		</td>
	</tr>

	<tr>
		<td width="200"  valign="top"  background="rutcolor.gif" style="border: 1px #000000 dotted;">
<div id="meny" >
<img src="top.gif" width="100%" height="33">
<center>
<table cellpadding="0" cellspacing="0" border="0"><tr><td align="center" valign="top" width="180" height="150">
<iframe src="klocka.html" width="150" height="150" marginwidth="0" marginheight="0" scrolling="no" frameborder="0"></iframe>
</td></tr></table>
</center>

</div>

		</td></tr>
</table></td></tr></table>

</BODY></HTML>