<img src="k1.gif" width="56" height="50" align="left"></div><div id="meny"><br></div><div id="rubrik">Filmklipp 
</div><div id="mit"><br>
och flash.<br>

<?


//inställningar!

  $os = "UNIX";
  $max_entry_per_page = "2000";
  $data_file = "filmklipp-pad";
  $this_script = "spel.php"; // detta är om du t.ex. har includerat scriptet i en annan sida. skriv länken till denna filen!

//Slut --- gör inget här under!!!!

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

<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.youtube.com/v/WSPJ2Cj3mYM"><img src="images/fcola.PNG" border="0" align="left" width="70" height="60">Patrik dricker Cola<br><br>Hur många Cola orkar du?<br></a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.youtube.com/v/IOJux-VEZh4"><img src="images/fdampbarn.PNG" border="0" align="left" width="70" height="60">Dampungar..<br><br>Roliga dapungar..!<br></a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://mondo.happytreefriends.com/watch_episodes/" target="_blank"><img src="http://mondo.happytreefriends.com/watch_episodes/images/ep_sm_flippin.gif" border="0" align="left" width="70" height="60">Happy-tree-friends<br><br>Inte mindre än 59 underbara avsnitt av<br>Happy-tree-friends som bara väntar på dig.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://home.datacomm.ch/marco.fernando/fla/bozzetto/olympics.swf"><img src="images/f4.gif" border="0" align="left" width="70" height="60">Mr.Ottos olympiska spel<br><br>En flash om olympiaden. Olika grenar,<br>och mycket oväntade slut.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://amuse.hamsterpaj.net/32.swf"><img src="images/f3.gif" border="0" align="left" width="70" height="60">Smoke Kills<br><br>En film som handlar om en snubbe som<br>röker. Mycket välgjord.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://web.telia.com/~u63804979/Krussidull.swf"><img src="images/f2.gif" border="0" align="left" width="70" height="60">Krussidull<br><br>En ganska skum film om en så<br>kallad krussidull. Typ en höna.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://media2.koreus.com/00044/200502/smart-bird.swf"><img src="images/ingen.gif" border="0" align="left" width="70" height="60">Einstein - Fågeln<br><br>En papegoja som kan prata och göra<br>massor av häftiga ljud. En riktig höjdare.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.humorsajten.com/filmer/funny_cats.wmv"><img src="images/ingen.gif" border="0" align="left" width="70" height="60">Roliga Katter<br><br>Ihop-klippta snuttar på katter <br>som gör olika roliga saker.</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://oliwen.mine.nu/filmer/CrazyFrog-AxelF.wmv"><img src="images/f1.gif" border="0" align="left" width="70" height="60">Crazy Frog - Axel F<br><br>Uppföljaren till Crazy Frog. Men nu är<br>han efterlyst och jagad.</a></b></td></tr>
<tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.humorsajten.com/filmer/life.wmv"><img src="images/ingen.gif" border="0" align="left" width="70" height="60"> Thats life<br><br>En film med massor av folk som <br>gör illa sig. Men den e kul...</a></b></td></tr><tr><td width="430" style="border: 1px #000000 dotted;" background="rutcolor.gif" align="left" height="60" onmouseover="this.className='psTipOnLeft';" onmouseout="this.className='';" valign="middle"><b><a href="http://www.lycktraffen.se/nydesign/spela.php?spel=http://www.mopperacing.se/morrf/images/the_annoying_thing_320x256.mpeg"><img src="images/ingen.gif" border="0" align="left" width="70" height="60">Crazy Frog<br><br>Den gamla klassikern, där Crazy Frog<br>åker på sin moppe.</a></b></td></tr>



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
      echo "Du måste skriva någonting! <script> setTimeout(\"history.go(-1)\",2000); </script>";
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

   echo "Ditt meddelande är skickat!";
break;
} //--end switch
?>