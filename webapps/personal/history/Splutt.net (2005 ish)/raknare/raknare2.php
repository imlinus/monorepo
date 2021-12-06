<?php 
// startar sessionen
session_start(); 

// om ingen session finns med rätt användarnamn och lösenord visas inloggningssidan igen
if (!isset($_SESSION["inloggning"]) || $_SESSION["inloggning"] !== true) {
header("Location: mellan.php"); 
exit; 
}
// om sessionen finns är inloggningen korrekt och då visas innehållet nedan:
?>
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Skyddad sida</title>
<style type="text/css">
<!--
body {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;}
h2 {font-family: Verdana, Arial, Helvetica, sans-serif;    font-size: 24px; color: #336633; letter-spacing: 2px; font-weight: normal;}
-->
</style>
</head>

<body> 
<h2>Besökare</h2>
<br><br><br>

<!--Start Counter from holmsund.org-->
<script language="JavaScript"> var HCounter = "";</script>
<script language="JavaScript">document.write("<" + "script src=\"http://counter.holmsund.org/counter.asp?ID=16414&sizeX=" + screen.width + "&sizeY=" + screen.height + "&ColorDepth=" + screen.colorDepth + "&referrer=" + escape(document.referrer) + "\"></" + "script" + ">");</script>
<script language="JavaScript">document.write(HCounter);</script>
<noscript>
<a href="http://www.holmsund.org/stats.asp?ID=16414" target="_blank"><img src="http://counter.holmsund.org/counter.asp?ID=16414" title="Counter powered by holmsund.org" border="0"></a>
</noscript>
<!--Stopp Counter from holmsund.org-->
<br><br><br><br>
<p><a href="logout.php">klicka h&auml;r f&ouml;r att logga ut</a></p> 
</body> 
</html> 