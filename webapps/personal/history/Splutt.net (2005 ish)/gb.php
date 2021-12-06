<img src="k4.gif" width="56" height="50" align="left"></div><div id="meny"><br></div><div id="rubrik">Gästbok
</div><div id="mit"><br>
<?php
session_start();


if(!(session_is_registered('gb')))
{
    
    include "form_gb.php";
    
    

}

else
{
}
?>




<?


//inställningar!

  $os = "UNIX";
  $max_entry_per_page = "20";
  $data_file = "gb";
  $this_script = "gb.php"; // detta är om du t.ex. har includerat scriptet i en annan sida. skriv länken till denna filen!

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



<font style="font-size: 14; font-family: verdana; color: black; ">




<?php
      $jml_page = intval($jmlrec/$max_entry_per_page);
      $sisa = $jmlrec%$max_entry_per_page;
      if ($sisa > 0) $jml_page++;
      $no = $page*$max_entry_per_page-$max_entry_per_page;
      if ($jmlrec == 0) echo "Ingen har skrivit ngt i chatten. Pass på, du kan bli först!";

        for ($i=0; $i<$max_entry_per_page; $i++) {
		    $no++;
		    $recno = $no-1;
		    if (isset($record[$recno])) {
		       $row = explode("|~~|",$record[$recno]);

			   echo "<b>$row[3]:</b><br>$row[5]";
			            
			
			   echo $row[6]."<hr color=\"black\" width=\"80%\">";
}}?>


<?
break;
case "add_form":
?>
<br><br>
<?
break;
case "add":
   $vname = isset($_POST['vname']) ? trim($_POST['vname']) : "";
   $vcomment = isset($_POST['vcomment']) ? trim($_POST['vcomment']) : "";

   if (strlen($vname) > 70) $vname = substr($vname,0,70);

   if ($vcomment=="" ) {
      echo "<script>alert('Du måste skriva någonting! '); setTimeout(\"history.go(-1)\",100); </script>";
      session_destroy();
	  exit;
   }


   $maxchar = 400;
   if (strlen($vcomment) > $maxchar) $vcomment = substr($vcomment,0,$maxchar)."...";

   $idx = date("YmdHis");
   $tgl = date("F d, Y - h:i A");

   $vname = str_replace("<","",$vname);
   $vname = str_replace(">","",$vname);
   $vname = str_replace("~","-",$vname);
   $vname = str_replace("\"","&quot;",$vname);

   $vcomment = str_replace("<","&lt;",$vcomment);
   $vcomment = str_replace(">","&gt;",$vcomment);
   $vcomment = str_replace("~","-",$vcomment);
   $vcomment = str_replace("\"","&quot;",$vcomment);

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

   
   echo "<script>alert('Ditt meddelande e skickat!'); setTimeout(\"history.go(-1)\",100); </script>";
   

break;
} //--end switch
?>

