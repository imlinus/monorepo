<img src="k3.gif" width="56" height="50" align="left"></div><div id="meny"><br></div><div id="rubrik">Tävling - Layouter
</div><div id="mit"><br>


	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="spel2.css"></link>
<table width="430" cellpadding="0" cellspacing="5" class="spel">


<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="layouts/tavling_1.PNG" rel="lightbox"><img src="layouts/tavling_1.PNG" border="0" align="left" width="70" height="60">Layout 1<br><br>En ljusblå design som påminner om "sweet vanilla"<br>designen, som finns i layout-arkivet.</a></td></tr>

<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="layouts/erixbidrag.gif" rel="lightbox"><img src="layouts/erixbidrag.gif" border="0" align="left" width="70" height="60">Layout 2<br><br>En lite mörkare design med inslag<br>av rött. Ja, se själva...</a></td></tr>

<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="layouts/tavling_2.PNG" rel="lightbox"><img src="layouts/tavling_2.PNG" border="0" align="left" width="70" height="60">Layout 3<br><br>Och så har vi ju också den<br>"gamla" splutt designen.</a></td></tr>


</table>
<br><br>
<SCRIPT LANGUAGE="JavaScript">

function openWebvoter(f) {
  vote="";
  url="http://www.webvoter.net/se/vote.cgi?id="+f.id.value;
  
  for(i=0;i<f.vote.length;i++) {
    if (f.vote[i].checked)
    {
	   if (i==0)
         vote="vote="+f.vote[i].value;
	   else
	     vote=vote+"&vote="+f.vote[i].value;
    }
  }
  if (vote != "") {
    url += "&" + vote
  }
  window.open(url,'webvoter','scrollbars=no,resizable=yes,width=485,height=600');
  return false;
}
</SCRIPT>
<FORM METHOD="POST" ACTION="http://www.webvoter.net/se/vote.cgi" onSubmit="return openWebvoter(this);">





<div align="center">

<B>Vilken layout är bäst?</B><BR>
<hr>
<br>
<INPUT TYPE="HIDDEN" NAME="id" VALUE="68460">
<INPUT TYPE="radio" NAME="vote" VALUE="583152">1<br>
<INPUT TYPE="radio" NAME="vote" VALUE="583153">2<br>
<INPUT TYPE="radio" NAME="vote" VALUE="609658">3<br>
<INPUT TYPE="submit" value="Rösta" style="font-family:arial, verdana; font-size:10px;">
    <A HREF="javascript:webvoter=window.open('http://www.webvoter.net/se/vote.cgi?id=68460','webvoter', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=485,height=550'); webvoter.focus(); void(0)"><FONT COLOR="#020304" size="-2">Se resultat</FONT></A>

</FORM>
<hr>
</div>










