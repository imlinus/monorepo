<img src="k3.gif" width="56" height="50" align="left"></div><div id="meny"><br></div><div id="rubrik">Bilder 
</div><div id="mit"><br>
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>

<?


//inställningar!

  $os = "UNIX";
  $max_entry_per_page = "2000";
  $data_file = "bild-pad";
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




<a href="images/image015.jpg" rel="lightbox"><img src="images/image015.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image014.jpg" rel="lightbox"><img src="images/image014.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image013.jpg" rel="lightbox"><img src="images/image013.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image012.jpg" rel="lightbox"><img src="images/image012.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image011.jpg" rel="lightbox"><img src="images/image011.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image010.jpg" rel="lightbox"><img src="images/image010.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image009.jpg" rel="lightbox"><img src="images/image009.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image008.jpg" rel="lightbox"><img src="images/image008.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image007.jpg" rel="lightbox"><img src="images/image007.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image006.jpg" rel="lightbox"><img src="images/image006.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image005.jpg" rel="lightbox"><img src="images/image005.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image004.jpg" rel="lightbox"><img src="images/image004.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image003.jpg" rel="lightbox"><img src="images/image003.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image002.jpg" rel="lightbox"><img src="images/image002.jpg" width="100" height="60" alt="" border="0"></a><a href="images/image001.jpg" rel="lightbox"><img src="images/image001.jpg" width="100" height="60" alt="" border="0"></a><a href="http://idiot.se/bilder/pic0005.jpg" rel="lightbox"><img src="http://idiot.se/bilder/pic0005.jpg" width="100" height="60" alt="" border="0"></a><a href="http://idiot.se/bilder/aftonbladet.gif" rel="lightbox"><img src="http://idiot.se/bilder/aftonbladet.gif" width="100" height="60" alt="" border="0"></a><a href="http://justfuckinggoogleit.com/bart.gif" rel="lightbox"><img src="http://justfuckinggoogleit.com/bart.gif" width="100" height="60" alt="" border="0"></a><a href="psp.gif" rel="lightbox"><img src="psp.gif" width="100" height="60" alt="" border="0"></a>
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