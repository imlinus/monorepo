<?php 
// startar sessionen
session_start(); 

// ange ditt anv�ndarnamn och l�senord i variablerna
$anvandarID = "splutt";
$losenord = "spluttnet";

if (isset($_POST["anvandarID"]) && isset($_POST["losenord"])) { 
    // kontrollerar om anv�ndarnamn och l�senord �r r�tt
    if ($_POST["anvandarID"] === $anvandarID && $_POST["losenord"] === $losenord) { 
    // ange den session som lagrar r�tt inloggningsuppgifter 
    $_SESSION["inloggning"] = true; 
    // efter r�tt inloggning f�rflyttas anv�ndaren till den skyddade sidan 
    header("Location: raknare2.php"); 
    exit; 
    } 
        // om anv�ndarnamn och l�senord �r fel lagras meddelandetexten i variabeln
        else {$felmeddelande = "Du har angivit fel anv�ndarnamn eller l�senord!";} 
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style type="text/css">
<!--
body {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;}
table {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; letter-spacing: 2px;}
h2 {font-family: Verdana, Arial, Helvetica, sans-serif;    font-size: 24px; color: #336633; letter-spacing: 2px; font-weight: normal;}
.kantlinje {border: 1px solid #99cc00;}
.formularfalt {border: 1px solid #99CC00; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; padding: 5px; border: 1px solid #99CC00;}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Logga in</title>
</head>

<body> 
<h2>Logga in </h2>
<p>Prova inloggningen med anv&auml;ndarnamnet <strong>ditt_namn</strong> och l&ouml;senordet <strong>ditt_password</strong>. </p>
<p>
<?php 
echo "<strong><font color='#ff0000'>" . $felmeddelande . "</font></strong>"; 
?> 
</p>
<form action="" method="post" name="loginform"> 
<table border="0" cellpadding="5" cellspacing="0" bgcolor="#ccff66" class="kantlinje"> 
<tr><td>Anv&auml;ndarnamn</td>
<td><input name="anvandarID" type="text" class="formularfalt"></td></tr>
<tr><td>L&ouml;senord</td>
<td><input name="losenord" type="password" class="formularfalt"></td></tr> 
<tr><td>&nbsp;</td>
<td><input type="submit" value="Logga in"></td></tr> 
</table> 
</form>
</body> 
</html> 