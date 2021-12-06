
<script language="javascript">
<!--
var klick = 0;

function reklam()
{
if(klick == 0)
  {
  alert('Du måste klicka på reklamlänken för att få skicka.');
  return false;
  }
  else
  {
  if(!document.form.regler.checked)
    {
    alert('Du måste godkänna villkoren för att få skicka.');
    return false;
    }
  else
  {
  return true;
  }
  }

}

function klicka()
{
klick = 1;
}

//-->
</script>


<br><br>
<table border="1"> <tr><td>

<form action="http://www.lycktraffen.se/mail.php" method="post" OnSubmit="return reklam()" name="form">

Email på mottagaren:</td><td><input type="text" name="till" size="30"><br></td></tr>

<tr><td>Meddelande:</td><td><textarea cols="50" rows="7" name="text"></textarea><br></td></tr>

<tr><td>Antal:</td><td><input type="text" name="times" size="10"> max 20<br></td></tr>

<tr><td><input type="checkbox" name="regler" checked>Jag godkänner<br>följande villkor:</td><td><textarea cols="50" rows="2" name="avtal" readonly="readonly">---------------------Villkor---------------------
Genom att använda denna tjänst godkänner du dessa villkor. Du får bara sända meddelanden till dig själv, (din egna e-mail) eller någon som du har informerat om utskicket (och den har accepterat det). Det kommer skickas med ett meddelande med mailet där det står att vi på splutt inte skickat det, och att det är anonymt. Eftersom mottagaren måste vara informerad om avsändaren, är alltså meddelandets anonymitet begränsad. Skulle du vilja skicka flera mail samtidigt med samma innehåll så finns även den möjligheten. Har du några frågor så kan du kontakta mig på erik_gm93@hotmail.com.</textarea></td></tr>

<tr><td><input type="submit" value="skicka!"></td><td><img src="http://imp.double.se/imp.gif?a16455p217g4317" width="0" height="0" alt=""><a href="http://click.double.net/click.php?a=16455&p=217&g=4317" onClick="klicka()" target="_blank">IT-Portalen.se - N&auml;r Ditt f&ouml;retag skall <br>synas p&aring; Internet!</a></td></tr></table><br>

</form>

