<img src="k2.gif" width="56" height="50" align="left"></div><div id="meny"><br></div><div id="rubrik">Spel 
</div><div id="mit"><br>
<script>
if (!document.layers)
document.write('<div id="divStayTopLeft" style="position:absolute">')
</script>

<layer id="divStayTopLeft">

<!--EDIT BELOW CODE TO YOUR OWN MENU-->
<script type="text/javascript">
/* Detta script finns att h�mta p� http://www.jojoxx.net och
   f�r anv�ndas fritt s� l�nge som dessa rader st�r kvar. */

var currentMatch;
var lastSearch=false;
function SearchText(qstr){
	if(!qstr){ return; }
	if(qstr!=lastSearch){ currentMatch=0; }
	lastSearch=qstr;
	if (navigator.appName == "Microsoft Internet Explorer"){
		var range=document.body.createTextRange();
		for(var i=0; range.findText(qstr); i++){
			if(i<=currentMatch){
				range.select();
				range.scrollIntoView();
			}
			range.moveStart("character",1);
		}
		if(currentMatch==i){
			alert("Inga fler spel hittades.");
		} else {
			currentMatch++;
		}
	} else if(navigator.appName=="Netscape"){
		find(qstr);
	}
}
</script>
<form onSubmit="SearchText(q.value); return false;" name="form">
<input type="text" name="q" value="Skriv s�kord h�r">
<input type="Submit" value="S�k spel" name="submit" onclick="document.form.submit.value='S�k n�sta'" >
</form>
<!--END OF EDIT-->

</layer>


<script type="text/javascript">

/*
Floating Menu script-  Roy Whittle (http://www.javascript-fx.com/)
Script featured on/available at http://www.dynamicdrive.com/
This notice must stay intact for use
*/

//Enter "frombottom" or "fromtop"
var verticalpos="frombottom"

if (!document.layers)
document.write('</div>')

function JSFX_FloatTopDiv()
{
	var startX = 3,
	startY = 150;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function()
	{
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : document.body.scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y)/1;
		}
		else{
		var pY = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		ftlObj.y += (pY - startY - ftlObj.y)/1;
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 10);
	}
	ftlObj = ml("divStayTopLeft");
	stayTopLeft();
}
JSFX_FloatTopDiv();
</script>




























<?


//inst�llningar!

  $os = "UNIX";
  $max_entry_per_page = "2000";
  $data_file = "spel-pad";
  $this_script = "spel.php"; // detta �r om du t.ex. har includerat scriptet i en annan sida. skriv l�nken till denna filen!

//Slut --- g�r inget h�r under!!!!

$do = isset($_REQUEST['do']) ? trim($_REQUEST['do']) : "";
$id = isset($_GET['id']) ? trim($_GET['id']) : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $HTTP_SERVER_VARS['PHP_SELF'];

if (!file_exists($data_file)) {
    echo "<b>Error !!</b> Kan inte hitta data filen : $data_file.<br>";
	exit;
}

switch ($do) {
case "":
   $record = file($data_file);
   rsort($record);
   $jmlrec = count($record);
?>
<link rel="stylesheet" type="text/css" href="spel2.css"></link>
<table width="430" cellpadding="0" cellspacing="5" class="spel">
<?php
      $jml_page = intval($jmlrec/$max_entry_per_page);
      $sisa = $jmlrec%$max_entry_per_page;
      if ($sisa > 0) $jml_page++;
      $no = $page*$max_entry_per_page-$max_entry_per_page;
      if ($jmlrec == 0) echo "";

        for ($i=0; $i<$max_entry_per_page; $i++) {
		    $no++;
		    $recno = $no-1;
		    if (isset($record[$recno])) {
		       $row = explode("|~~|",$record[$recno]);

			   echo "$row[5]";
			            			
			   echo "$row[6]";
}}?>




<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/suget/lust_for_bust.swf"><img src="images/lfb.PNG" border="0" align="left" width="70" height="60">Lust For Bust<br><br>Du ska f�rs�ka att titta p� tjejjens br�st,<br>men akta dig s� att du inte blir uppt�ckt</a></b></td>

<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://fpflashfarm.com/FB49PFBFFKJ42BF/3755_DD2woP5.swf"><img src="images/def2.bmp" border="0" align="left" width="70" height="60">Demonic Defence 3<br><br>Ett lite mer utvecklat defend-spel d�r du ska klicka<br>p� gubbarna. Man kan �ven k�pa t.ex gunmans</a></b></td></tr>

<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/frame.php?frame=http://www.teagames.com/games/crazygolf2/play.php" target="_blank"><img src="images/mini.bmp" border="0" align="left" width="70" height="60">Crazy Golf 2<br><br>Ett roligt minigolf-spel. Spelas med<br>hj�lp av musen. 4 olika sv�righetsgrader.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.snabbstart.com/files/filmsflash/69a1360024.swf"><img src="images/def.bmp" border="0" align="left" width="70" height="60">Defend your castle<br><br>F�rsvara ditt slott mot folkmassorna som <br>stormar ditt slott. Du ska kasta dem s� dom d�r.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://flasharcade.com/games/Micro_Tanks/microtanks.swf"><img src="images/micro.bmp" border="0" align="left" width="70" height="60">Microtanks<br><br>2D spel d�r du styr en pansarvagn. Skjut <br>motst�ndaren innan den skjuter dig. Multiplayer</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;"  align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.onemorelevel.com/games2/simpsonmaker.swf"><img src="images/Simpsonmaker" border="0" align="left" width="70" height="60">Simpson Maker<br><br>Du g�r din egen simpson figur.<br>inte mycket till spel men kul �r det..!</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;"  align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/suget/night_fight.swf"><img src="images/night_fight" border="0" align="left" width="70" height="60">Night Fight<br><br>ett spel d�r du ska f� en liten boll att l�sa in <br>de st�rre bollarna..</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;"  align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/motor/parking_perfection_2.swf"><img src="images/parking.PNG" border="0" align="left" width="70" height="60">Parking Perfection<br><br>Du ska parkera en bil...<br></a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;"  align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/action/playing_field_2.swf"><img src="images/Playingfield.PNG" border="0" align="left" width="70" height="60">PlayingField 2<br><br>Ett roligt spel som g�r ut p� att D�DA, D�DA och D�DA<br></a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://starskyandhutchmovie.warnerbros.com/pinball/pinball.swf"><img src="images/flipper.png" border="0" align="left" width="70" height="60">Pinball<br><br>Flipperspel med upp till 4 spelare. Det k�nns <br>on�digt att f�rklara, alla vet v�l hur man g�r?</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.onemorelevel.com/games2/camperstrike2.swf"><img src="images/cc.png" border="0" align="left" width="70" height="60">Counterstrike Light<br><br>Som det gamla Camper-Strike. Skjut<br>P� m�ltavlorna som �ker f�rbi.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/strategi/wone_2.swf"><img src="images/W0ne.PNG" border="0" align="left" width="70" height="60">Wone<br><br>Du �r typ ett bilhjul och ska f�nga <br>guldbollar och stj�rnor. P� tid.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/ovrigt/ball_bounce.swf"><img src="images/22.PNG" border="0" align="left" width="70" height="60">Ball Bounce<br><br>F� bollen att studsa i r�tt vinkel,<br>s� att den n�r andra sidan rutan.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://sd1224.sivit.org/random_0855/files/2836.swf"><img src="images/11.PNG" border="0" align="left" width="70" height="60">Popup Killer<br><br>St�ng s� m�nga popups som m�jligt.<br>Det dyker hela tiden upp nya. =P</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://70.84.248.90/~fetchga/Games-D5-140406/paint-ball.swf"><img src="images/Kulspelet.PNG" border="0" align="left" width="70" height="60">Kulspelet<br><br>Rita linjer som bollen ska studsa p�.<br>P�minner om Linerrider & Drawplay.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.humorsajten.com/flash/pilsstrip.swf"><img src="images/19.gif" border="0" align="left" width="70" height="60">Pilstrip<br><br>En klassiker d�r du ska samla p� flaskor<br>och kl� av tjejen.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.bbc.co.uk/sportacademy/main.swf"><img src="images/18.gif" border="0" align="left" width="70" height="60">Denise Lewis Heptathlon<br><br>Du �r en friidrottare, som ska utf�ra <br>massor av grenar. Ganska sv�rt i b�rjan.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://gsfiles.com/hosted009/ammoambush2.swf"><img src="images/17.gif" border="0" align="left" width="70" height="60">Ammobush 2<br><br>Ett roligt spel d�r du anv�nder en AWP<br>som ditt vapen.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/frame.php?frame=http://www.teagames.com/games/alpinefreestyle/play.php" target="_blank"><img src="images/16.gif" border="0" align="left" width="70" height="60">Alpine Freestyle<br><br>Ett sv�rt snowboard-spel med<br>3 olika sv�righetsgrader.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.mcvideogame.com/mcdonalds-eng.swf"><img src="images/15.gif" border="0" align="left" width="70" height="60">McDonalds<br><br>Sk�t om ditt eget McDonalds.<br>Riktigt sv�rt men roligt.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/motor/copter.swf"><img src="images/14.gif" border="0" align="left" width="70" height="60">Copter<br><br>En gammal men rolig klassiker<br>d�r du �ker med en helikopter</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://media1.hallpass.com/mediaStorage/6042.swf"><img src="images/13.gif" border="0" align="left" width="70" height="60">Stunt Bike Draw<br><br>Ett sv�rt men roligt Stunt spel<br>d�r du sj�lv ritar banan</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.2flashgames.com/anfh2198f23lradf/flash/f-Draw-Play-3302.swf"><img src="images/12.gif" border="0" align="left" width="70" height="60">Draw Play<br><br>Ett roligt spel d�r du ritar en bana<br>som gubben sedan ska g�</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.linerider.fr/linerider/zada.swf"><img src="images/11.gif" border="0" align="left" width="70" height="60">Linerider V1.3<br><br>Rita linjer so den lilla gubben ska<br>�ka p�. Kul, men finns inget "m�l".</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/strategi/tanks.swf"><img src="images/10.gif" border="0" align="left" width="70" height="60">Tanks<br><br>Styr din stridsvagn och skjut p� de<br>andra stridsvagnarna. Multiplayer</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/frame.php?frame=http://www.bumperball.com" target="_blank"><img src="images/9.gif" border="0" align="left" width="70" height="60">Bumperball<br><br>Tv� radiobilar. En hockey-plan. En liten boll. <br>Kan det bli roligare? Sv�rt att s�ga. Multiplayer </a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.jesper.nu/onlinespel/skjutspel/playing_with_fire_2.swf"><img src="images/8.gif" border="0" align="left" width="70" height="60">Playing with fire 2<br><br>Uppf�ljaren till det popul�ra spelet.<br>Kasta bomber p� fienden. Multiplayer </a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/frame.php?frame=http://www.teagames.com/games/tgmotocross2/play.php" target="_blank"><img src="images/7.gif" border="0" align="left" width="70" height="60">Tg Motorcross 2<br><br>K�r motorcross och f�rs�k<br>ta dig fram, hoppa �ver stup m.m. 2D</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.needtoshout.com/video/nae/alien.swf"><img src="images/5.gif" border="0" align="left" width="70" height="60">Alien Hominid<br><br>Du �r en alien. Skjut FBI innan<br>dom skjuter dig.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://i.a.cnn.net/si/sifk/games/bmx/bmx.swf"><img src="images/4.gif" border="0" align="left" width="70" height="60">Sik trix BMX<br><br>Cykla BMX. Hoppa p� hopp, g�r<br>trick och ha kul.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/frame.php?frame=http://www.xgenstudios.com/play/stickarena/" target="_blank"><img src="images/6.gif" border="0" align="left" width="70" height="60">Stick Arena<br><br>I detta spel �r du en streckgubbe<br>och ska skjuta andra onlinespelare.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.funflashgames.com/resources/games/swfs/54542.swf"><img src="images/3.gif" border="0" align="left" width="70" height="60">Frispark<br><br>Du ska l�gga frisparkar fr�n olika<br>vinklar. Beroendeframkallande.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.goriya.com/flash/games/sonic1.swf"><img src="images/2.gif" border="0" align="left" width="70" height="60">Sonic<br><br>Det klassiska Sonic-spelet d�r<br>man ska f�nga ringar och undvika monster.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.breaktaker.com/albums/games/control/BallToucher.swf"><img src="images/1.gif" border="0" align="left" width="70" height="60">BallToucher<br><br>Detta �r spelet d� du ska f�nga vissa <br>bollar och undvika andra. Styr med musen.</a></b></td></tr>
</table>










<?
break;
case "add_form":
?>
  <form method="post" action="<?php echo $this_script; ?>">
      <input type="hidden" name="do" value="add">
            <table border="0">
	     <tr>
		<td>Smeknamn:</td>
		<td><input type="text" name="vname"></td>
	     </tr>
              <tr>
                <td width="100">
                  Meddelande:
                </td>
                <td>
<input type="text" name="vcomment" size="40"></textarea>
                </td>
              </tr>
            </table>
         <input type="submit" value="Skicka ditt meddelande">
    </form> 
<?
break;
case "add":
   $vname = isset($_POST['vname']) ? trim($_POST['vname']) : "";
   $vcomment = isset($_POST['vcomment']) ? trim($_POST['vcomment']) : "";

   if (strlen($vname) > 70) $vname = substr($vname,0,70);

   if ($vcomment=="" ) {
      echo "Du m�ste skriva n�gonting! <script> setTimeout(\"history.go(-1)\",2000); </script>";
	  exit;
   }


   $maxchar = 1000;
   if (strlen($vcomment) > $maxchar) $vcomment = substr($vcomment,0,$maxchar)."...";

   $idx = date("YmdHis");
   $tgl = date("F d, Y - h:i A");

   $vname = str_replace("<","",$vname);
   $vname = str_replace(">","",$vname);
   $vname = str_replace("~","-",$vname);
   $vname = str_replace("\"","&quot;",$vname);

   $vcomment = str_replace("<","<",$vcomment);
   $vcomment = str_replace(">",">",$vcomment);
   $vcomment = str_replace("~","~",$vcomment);
   $vcomment = str_replace("\"","\"",$vcomment);

   if (strtoupper($os) == "WIN") {
	   $vcomment = str_replace("\r\n","<br>",$vcomment);
	   $vcomment = str_replace("\r","",$vcomment);
	   $vcomment = str_replace("\n","",$vcomment);
   } else {
	   $vcomment = str_replace("\n","<br>",$vcomment);
	   $vcomment = str_replace("\r","",$vcomment);
   }

   $newdata = "|~~|$idx|~~|$tgl|~~|$vname|~~||~~||~~|$vcomment|~~||~~||~~|\n";
   $newdata = stripslashes($newdata);

   $bagus = true;
/*-----------------------------------------------------
   $cekdata = file($data_file);
   $jmlcekdata = count($cekdata);
   if ($jmlcekdata > 0) {
      rsort($cekdata);
      if ($jmlcekdata > 2) {
         $newrow = explode("|~~|",$newdata);
	     $jmlentry = 0;
         for ($c=0; $c<4; $c++) {
             $cekrow = explode("|~~|",$cekdata[$c]);
             if ($cekrow[4] == $newrow[4] or ($cekrow[3] == $newrow[3] and $cekrow[5] == $newrow[5])) {
				 $jmlentry++;
			 }
	     }
         $bagus = ($jmlentry < 3) ? true : false;
      }
   }
------------------------------------------------------*/

   if ($bagus) {
   $tambah = fopen($data_file,"a");
   if (strtoupper($os)=="UNIX") {
      if (flock($tambah,LOCK_EX)) {
	     fwrite($tambah,$newdata);
	     flock($tambah,LOCK_UN);
      }
   } else {
	   fwrite($tambah,$newdata);
   }
   fclose($tambah);
   }

   echo "Ditt meddelande �r skickat!";
break;
} //--end switch
?>