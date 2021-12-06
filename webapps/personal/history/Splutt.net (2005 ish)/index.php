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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Splutt.net - Spel och annat kul..!</title>
<link href="default.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<meta name="revisit-after" content="12 Hours" />
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<meta name="author" content="erik granstedt m&#246;ller, linus lilja" />
	<meta name="copyright" content="http://www.splutt.net" />
	<meta name="rating" content="general" />
	<meta name="doc-class" content="completed" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="" />
	<meta name="description" content="P&#229; denna sida hittar du t.ex online-spel och roliga bilder."> 
	<meta name="keywords" content="splutt, onlinespel, bus, downloads, filmklipp, roliga bilder"> 
</head>
<body><center><div id="meny">
	<a href="?visa=start">Hem</a> |
	<a href="?visa=spel">Onlinespel</a> |
	<a href="?visa=filmklipp">Filmer</a> |
	<a href="?visa=bilder">Bilder</a> |
	<a href="?visa=mobilt">Mobilt</a> |
	<a href="?visa=bus">Bus</a> |
	<a href="?visa=downloads">Downloads</a> |
	<a href="?visa=webradio">Webradio</a> |
	<a href="?visa=lankar">L&#228;nkar</a> |
	<a href="?visa=kontakt">Kontakt</a> |
	<a href="?visa=copyright">Copyright</a></div>
</center>
<div id="header">
	<h1><a href="#">&nbsp;</a></h1>
</div>
<div id="content">
	<div id="colOne">
		<div class="post">
	
<!-- Login börjar här -->	
	
</center>
<form action="index.php" method="post">
<INPUT TYPE="text" name="user"SIZE="20" onblur="if(this.value == '') this.value = 'användarnamn';" onfocus="if(this.value == 'användarnamn') this.value = '';" VALUE="användarnamn">
&nbsp;&nbsp;
<INPUT TYPE="password" name="passwd "SIZE="20" onblur="if(this.value == '') this.value = 'användarnamn';" onfocus="if(this.value == 'användarnamn') this.value = '';" VALUE="användarnamn">&nbsp;&nbsp;&nbsp;

<input type="submit" name="submit" disabled="disabled" value="Logga in">&nbsp;&nbsp;//<a href="?visa=register">Registrera</a></center>
<br>

<!-- Och slutar här -->

	</div></div></div>
<div id="mitten">
	<div id="colOne">
		<div class="post">
<center>
<?php


if (isset($_GET['visa'])) {

    if (file_exists($_GET['visa'].".php")) {

        include $_GET['visa'].".php";

    } else {

        echo "Denna sida kunde tyvärr inte visas.";

    }

}
else {
    include "start.php";
}



?>
</center>
			</div></div>
</div>

<div id="footer">
	<p>Copyright &copy; n' Design by <a href="http://www.splutt.net"><strong>Splutt</strong></a></p>
</div>
</body>
</html>
