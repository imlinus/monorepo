
<script language="javascript">
<!--
var klick = 0;

function reklam()
{
if(klick == 0)
  {
  alert('Du m�ste klicka p� reklaml�nken f�r att f� skicka.');
  return false;
  }
  else
  {
  if(!document.form.regler.checked)
    {
    alert('Du m�ste godk�nna villkoren f�r att f� skicka.');
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

Email p� mottagaren:</td><td><input type="text" name="till" size="30"><br></td></tr>

<tr><td>Meddelande:</td><td><textarea cols="50" rows="7" name="text"></textarea><br></td></tr>

<tr><td>Antal:</td><td><input type="text" name="times" size="10"> max 20<br></td></tr>

<tr><td><input type="checkbox" name="regler" checked>Jag godk�nner<br>f�ljande villkor:</td><td><textarea cols="50" rows="2" name="avtal" readonly="readonly">---------------------Villkor---------------------
Genom att anv�nda denna tj�nst godk�nner du dessa villkor. Du f�r bara s�nda meddelanden till dig sj�lv, (din egna e-mail) eller n�gon som du har informerat om utskicket (och den har accepterat det). Det kommer skickas med ett meddelande med mailet d�r det st�r att vi p� splutt inte skickat det, och att det �r anonymt. Eftersom mottagaren m�ste vara informerad om avs�ndaren, �r allts� meddelandets anonymitet begr�nsad. Skulle du vilja skicka flera mail samtidigt med samma inneh�ll s� finns �ven den m�jligheten. Har du n�gra fr�gor s� kan du kontakta mig p� erik_gm93@hotmail.com.</textarea></td></tr>

<tr><td><input type="submit" value="skicka!"></td><td><img src="http://imp.double.se/imp.gif?a16455p217g4317" width="0" height="0" alt=""><a href="http://click.double.net/click.php?a=16455&p=217&g=4317" onClick="klicka()" target="_blank">IT-Portalen.se - N&auml;r Ditt f&ouml;retag skall <br>synas p&aring; Internet!</a></td></tr></table><br>

</form>

