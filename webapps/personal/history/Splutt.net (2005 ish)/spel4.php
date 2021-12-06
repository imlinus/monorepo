<HTML><BODY LEFTMARGIN="0" TOPMARGIN="0"><HEAD>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<TITLE>SPLUTT</TITLE></HEAD>
	<link rel="stylesheet" href="css.css" type="text/css">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td align="center" valign="center"><!-- 


<embed src="http://piv.pivpiv.dk/youareai.swf" width="600" height="900" border="0" margin="0" padding="0" scrolling="no" autoplay="true" hidden="false"> 


















































































































-->

<?php

echo "Utmana en kompis? Här är adressen:<br><input type=\"text\" value=\"";
echo "http://www.splutt.net/spela.php?spel=";
echo $_GET['spel'];
echo "\" size=\"20\">";

if (isset($_GET['spel'])) {

        echo "<embed src=\"";
        echo $_GET['spel'];
        echo " \" width=\"800\"";
        echo " height=\"600\">";

    } else {

        echo "Bruten länk...";

    }














?></td></tr></table></BODY></HTML>